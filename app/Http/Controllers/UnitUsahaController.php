<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Position;
use App\Models\rolePembayaran;
use App\Models\rolePengadaan;
use App\Models\rolePettyCash;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitUsahaController extends Controller
{
    //
    public function index(Request $request)
    {
        $unitUsaha =  DB::table('unit_usaha')
            ->select(
                'unit_usaha.*',
                DB::raw('(SELECT COUNT(*) FROM users WHERE users.id_positions = unit_usaha.id) as user_count')
            )->orderBy("unit_usaha.id", "desc");

        if (isset($_GET['btn-submit'])) {
            if (isset($_GET['cari_nama'])) {
                if ($_GET['cari_nama'] != "") {
                    $unitUsaha = $unitUsaha->where("unit_usaha.name", "like", "%" . $_GET['cari_nama'] . "%");
                }
            }
            if (isset($_GET['kategori_bisnis'])) {
                if ($_GET['kategori_bisnis'] != "") {
                    $unitUsaha = $unitUsaha->where("unit_usaha.id_unit_bisnis", "=",  $_GET['kategori_bisnis']);
                }
            }
        }

        $unitUsaha = $unitUsaha->paginate(10);

        return view('dashboard.pages.unitUsaha.index', compact('unitUsaha'));
    }

    public function detailUsaha(Request $request, $index)
    {
        $unitUsaha = DB::table('unit_usaha')
            ->select(
                'unit_usaha.*',
                DB::raw('(SELECT COUNT(*) FROM users WHERE users.id_positions = unit_usaha.id) as user_count')
            )->where("unit_usaha.id", $index)->first();
        $users = User::where("id_positions", $index)->orderBy("id", "desc")->paginate(10);

        $users_pembayaran = User::where("id_positions", "!=", "0")->where("id_positions", $index)->where("status", 1)->orderBy("role_pembayaran", "asc")->get();
        $jabatan = Position::where("deleted_at", null)->orderBy("name", "asc")->get();
        $menu = Menu::where("is_active", 1)->get();

        $roleList = User::where("id_positions", "!=", "0")->where("id_positions", $index)->distinct('role_id')->get();

        $users_pengadaan = DB::table('role_pengadaan')->select("role_pengadaan.*", "positions.name")
            ->where(function ($query) use ($index) {
                $query->where('role_pengadaan.id_unit_usaha', $index);
            })
            ->where("role_pengadaan.tipe_surat", 0)
            ->join("positions", "positions.id", "role_pengadaan.id_role")
            ->orderBy('role_pengadaan.urutan', 'asc')
            ->get();

        $lastNumPengadaan = DB::table('role_pengadaan')->where("id_unit_usaha", $index)->where("aktif", "1")->orderBy("urutan", "desc")->first();

        $users_pengadaan_lainnya = DB::table('role_pengadaan')->select("role_pengadaan.*", "positions.name")
            ->where(function ($query) use ($index) {
                $query->where('role_pengadaan.id_unit_usaha', $index);
            })
            ->where("role_pengadaan.tipe_surat", 1)
            ->join("positions", "positions.id", "role_pengadaan.id_role")
            ->orderBy('role_pengadaan.urutan', 'asc')
            ->get();

        $users_pengadaan_penghapusan = DB::table('role_pengadaan')->select("role_pengadaan.*", "positions.name")
            ->where(function ($query) use ($index) {
                $query->where('role_pengadaan.id_unit_usaha', $index);
            })
            ->where("role_pengadaan.tipe_surat", 2)
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

        $users_maintenance = DB::table('role_pengadaan')->select("role_pengadaan.*", "positions.name")
            ->where(function ($query) use ($index) {
                $query->where('role_pengadaan.id_unit_usaha', $index);
            })
            ->where("role_pengadaan.tipe_surat", 3)
            ->join("positions", "positions.id", "role_pengadaan.id_role")
            ->orderBy('role_pengadaan.urutan', 'asc')
            ->get();

        $users_holding = User::where("id_positions", "!=", "0")->where("status", 1)->get();

        return view('dashboard.pages.unitUsaha.component.detail', compact('roleList', 'lastNumPengadaan', 'users_pengadaan_penghapusan', 'unitUsaha', 'users_pengadaan_lainnya', 'users', 'jabatan', 'users_pengadaan', 'users_pembayaran', 'menu', 'users_petty_cash', 'users_maintenance'));
    }

    public function editPosPembayaran(Request $request)
    {
        $indexUsaha = $request->t_index_pembayaran;
        $roleCount = $request->t_jumlah_role_pembayaran;

        $dds = "";

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pembayaran_" . $an);
            $posRole = $request->input("role_pembayaran_" . $an);

            $dds .= $idRole . "/";

            $valChecked = $request->input("checked_role_pembayaran_" . $an);
            $stss = $request->input("select_role_pembayaran_" . $an);

            $sts_reject = $request->input("checked_role_rj_pengadaan_" . $an) ? true : false;
            $sts_menyetujui = $request->input("checked_role_is_mt_pengadaan_" . $an) ? true : false;

            rolePembayaran::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "menyetujui" => $stss,
                "rj" => $sts_reject,
                "is_menyetujui" => $sts_menyetujui,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pembayaran"]), 'status' => 200], 200);
    }

    public function usahaPost(Request $request)
    {
        $nominal = $request->limit_petty_cash;

        $nominal = str_replace("Rp ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $insert = DB::table('unit_usaha')->insert([
            'name' => $request->unitUsaha,
            'id_unit_bisnis' => $request->id_unit_bisnis,
            'limit_petty_cash' => $nominal,
            'jumlah_unit' => 0,
            'status' => $request->chk_aktif === null ? "0" : $request->chk_aktif
        ]);

        if ($insert) {
            return response()->json(['message' => 'Add Unit Usaha Success', 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Gagal Update Usaha Success', 'status' => 400], 400);
        }
    }

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
            $rjChecked = $request->input("checked_role_rj_pengadaan_" . $an) ? true : false;
            $rjMenyetujui = $request->input("checked_role_is_mt_pengadaan_" . $an) ? true : false;

            rolePengadaan::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "menyetujui" => $stss,
                "rj" => $rjChecked,
                "is_menyetujui" => $rjMenyetujui,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pengadaan"]), 'status' => 200], 200);
    }

    public function hapusUnitUsaha(Request $request, $index)
    {
        UnitUsaha::where("id", $index)->delete();

        return redirect("dashboard/unit-usaha?index=1");
    }

    public function deleteRolePengadaan(Request $request, $index, $segment, $modules)
    {
        if ($modules === "pengadaan") {
            rolePengadaan::where("id", $index)->delete();
        } else if ($modules === "pembayaran") {
            rolePembayaran::where("id", $index)->delete();
        } else if ($modules === "pettycash") {
            rolePettyCash::where("id", $index)->delete();
        }

        return redirect("dashboard/detail-usaha/" . $segment . "?tab=" . $modules);
    }

    public function editPosPengadaanMaintenance(Request $request)
    {
        $indexUsaha = $request->t_index_pengadaan_maintenance;
        $roleCount = $request->t_jumlah_role_pengadaanMaintenance;
        $dds = "";

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pengadaan_maintenance_" . $an);
            $posRole = $request->input("role_pengadaan_maintenance_" . $an);

            $dds .= $idRole . "/";

            $valChecked = $request->input("checked_role_maintenance_" . $an);
            $stss = $request->input("scmaintenance_role_pengadaan_maintenance_" . $an);

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
        $dds = "";

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pengadaan_lainnya_" . $an);
            $posRole = $request->input("role_pengadaan_lainnya_" . $an);

            $dds .= $idRole . "/";

            $valChecked = $request->input("checked_role_lainnya_" . $an);
            $stss = $request->input("scLainnya_role_pengadaan_lainnya_" . $an);

            rolePengadaan::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "menyetujui" => $stss,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pengadaan"]), 'status' => 200], 200);
    }

    public function editPosPengadaanHapus(Request $request)
    {
        $indexUsaha = $request->t_index_pengadaan_penghapusan;
        $roleCount = $request->t_jumlah_role_pengadaanPenghapusan;
        $dds = "";

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pengadaan_penghapusan_" . $an);
            $posRole = $request->input("role_pengadaan_penghapusan_" . $an);

            $dds .= $idRole . "/";

            $valChecked = $request->input("checked_role_penghapusan_" . $an);
            $stss = $request->input("scpenghapusan_role_pengadaan_penghapusan_" . $an);

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
