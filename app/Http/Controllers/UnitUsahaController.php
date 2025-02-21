<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Position;
use App\Models\rolePembayaran;
use App\Models\rolePengadaan;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitUsahaController extends Controller
{
    //
    public function index(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("id", "desc")->paginate(10);

        return view('dashboard.pages.unitUsaha.index', compact('unitUsaha'));
    }

    public function detailUsaha(Request $request, $index)
    {
        $unitUsaha = UnitUsaha::where("id", $index)->first();
        $users = User::where("id_positions", $index)->orderBy("id", "desc")->paginate(10);

        $users_pembayaran = User::where("id_positions", "!=", "0")->where("id_positions", $index)->where("status", 1)->orderBy("role_pembayaran", "asc")->get();
        $jabatan = Position::where("deleted_at", null)->get();
        $menu = Menu::where("is_active", 1)->get();

        $roleList = User::where("id_positions", "!=", "0")->where("id_positions", $index)->distinct('role_id')->get();

        // return response()->json($roleList);
        // die();

        // $users_pengadaan = User::where("id_positions" , "!=" , "0")->where("id_positions" , $index)->where("status" , 1)->orderBy("role_pengadaan","asc")->get();
        // $users_holding = User::where("id_positions" , "!=" , "0")->where("status" , 1)->get();

        $users_pengadaan = DB::table('role_pengadaan')->select("role_pengadaan.*", "positions.name")
            ->where(function ($query) use ($index) {
                $query->where('role_pengadaan.id_unit_usaha', $index);
            })
            ->where("role_pengadaan.tipe_surat", 0)
            ->join("positions", "positions.id", "role_pengadaan.id_role")
            ->orderBy('role_pengadaan.urutan', 'asc')
            ->get();

        $users_pengadaan_lainnya = DB::table('role_pengadaan')->select("role_pengadaan.*", "positions.name")
            ->where(function ($query) use ($index) {
                $query->where('role_pengadaan.id_unit_usaha', $index);
            })
            ->where("role_pengadaan.tipe_surat", 1)
            ->join("positions", "positions.id", "role_pengadaan.id_role")
            ->orderBy('role_pengadaan.urutan', 'asc')
            ->get();

        $users_pembayaran = DB::table('role_pembayaran')->select("role_pembayaran.*", "positions.name")
            ->where(function ($query) use ($index) {
                $query->where('role_pembayaran.id_unit_usaha', $index);
            })
            ->join("positions", "positions.id", "role_pembayaran.id_role")
            ->orderBy('role_pembayaran.urutan', 'asc')
            ->get();

        $users_petty_cash = DB::table('role_petty_cash')->select("role_petty_cash.*", "positions.name")
            ->where(function ($query) use ($index) {
                $query->where('role_petty_cash.id_unit_usaha', $index);
            })
            ->join("positions", "positions.id", "role_petty_cash.id_role")
            ->orderBy('role_petty_cash.urutan', 'asc')
            ->get();

        $users_holding = User::where("id_positions", "!=", "0")->where("status", 1)->get();

        return view('dashboard.pages.unitUsaha.component.detail', compact('roleList', 'unitUsaha', 'users_pengadaan_lainnya', 'users', 'jabatan', 'users_pengadaan', 'users_pembayaran', 'menu', 'users_petty_cash'));
    }

    public function editPosPembayaran(Request $request)
    {
        // $indexUsaha = $request->t_index_pembayaran;
        // $roleCount = $request->t_jumlah_role_pembayaran;

        // for ($an = 1; $an <= $roleCount; $an++) {
        //     $idRole = $request->input("id_role_pembayaran_" . $an);
        //     $posRole = $request->input("role_pembayaran_" . $an);

        //     User::where("id", $idRole)->update(array(
        //         "role_pembayaran" => $posRole
        //     ));
        // }

        // return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pembayaran"]), 'status' => 200], 200);
        $indexUsaha = $request->t_index_pembayaran;
        $roleCount = $request->t_jumlah_role_pembayaran;

        // echo $roleCount;
        // die();
        $dds = "";

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pembayaran_" . $an);
            $posRole = $request->input("role_pembayaran_" . $an);

            $dds .= $idRole . "/";

            $valChecked = $request->input("checked_role_pembayaran_" . $an);
            $stss = $request->input("scBiasa_role_pengadaan_" . $an);

            rolePembayaran::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "menyetujui" => $stss,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pembayaran"]), 'status' => 200], 200);
    }

    public function usahaPost(Request $request)
    {
        $insert = DB::table('unit_usaha')->insert([
            'name' => $request->unitUsaha,
            'id_unit_bisnis' => $request->id_unit_bisnis,
            'limit_petty_cash' => $request->limit_petty_cash,
            'jumlah_unit' => 0,
            'status' => $request->chk_aktif === null ? "0" : $request->chk_aktif
        ]);

        if ($insert) {
            return response()->json(['message' => 'Add Unit Usaha Success', 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Gagal Update Usaha Success', 'status' => 400], 400);
        }
    }

    // public function editPosPengadaan(Request $request)
    // {
    //     $indexUsaha = $request->t_index_pengadaan;
    //     $roleCount = $request->t_jumlah_role;

    //     for ($an = 1; $an <= $roleCount; $an++) {
    //         $idRole = $request->input("id_role_pengadaan_" . $an);
    //         $posRole = $request->input("role_pengadaan_" . $an);

    //         User::where("id", $idRole)->update(array(
    //             "role_pengadaan" => $posRole
    //         ));
    //     }

    //     return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pengadaan"]), 'status' => 200], 200);
    // }

    public function editPosPengadaan(Request $request)
    {
        $indexUsaha = $request->t_index_pengadaan;
        $roleCount = $request->t_jumlah_role_pengadaan;

        // echo $roleCount;
        // die();
        $dds = "";

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pengadaan_" . $an);
            $posRole = $request->input("role_pengadaan_" . $an);

            $dds .= $idRole . "/";

            $valChecked = $request->input("checked_role_pengadaan_" . $an);
            $stss = $request->input("scBiasa_role_pengadaan_" . $an);

            rolePengadaan::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "menyetujui" => $stss,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pengadaan"]), 'status' => 200], 200);
    }

    public function editPosPengadaanLainnya(Request $request)
    {
        $indexUsaha = $request->t_index_pengadaanLainnya;
        $roleCount = $request->t_jumlah_role_pengadaanLainnya;

        // echo $roleCount;
        // die();
        $dds = "";

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pengadaan_lainnya_" . $an);
            $posRole = $request->input("role_pengadaan_lainnya_" . $an);

            $dds .= $idRole . "/";

            $valChecked = $request->input("checked_role_pengadaan_lainnya_" . $an);
            $stss = $request->input("scLainnya_role_pengadaan_lainnya_" . $an);

            rolePengadaan::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "menyetujui" => $stss,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pengadaan"]), 'status' => 200], 200);
    }

    public function usahaEdit(Request $request)
    {
        $update = UnitUsaha::where("id", $request->t_index)->update(array(
            "name" => $request->unitUsaha,
            "id_unit_bisnis" => $request->id_unit_bisnis,
            "limit_petty_cash" => $request->limit_petty_cash,
            'status' => $request->chk_aktif === null ? "0" : $request->chk_aktif
        ));

        if ($update) {
            return response()->json(['message' => 'Update Unit Usaha Success', 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Gagal Update Usaha Success', 'status' => 400], 400);
        }
    }
}
