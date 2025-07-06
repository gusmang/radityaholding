<?php

namespace App\Http\Controllers;

use App\Models\AccessMenu;
use Session;
use App\Models\Menu;
use App\Models\User;
use App\Models\Position;
use App\Models\roleHolding;
use App\Models\rolePembayaran;
use App\Models\rolePengadaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $position = Position::paginate(10);

        return view('dashboard.pages.jabatan.index', compact('position'));
    }

    public function deleteposition(Request $request)
    {
        $position = Position::find($request->id);

        if ($position->delete()) {
            return response()->json([
                'message' => 'Role Posisi Berhasil DiHapus!',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Role Posisi Gagal Dihapus!',
                'status' => 500
            ]);
        }
    }

    public function delete_user(Request $request)
    {
        $position = User::find($request->id);

        if ($position->delete()) {
            return response()->json([
                'message' => 'Role Posisi Berhasil DiHapus!',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Role Posisi Gagal Dihapus!',
                'status' => 500
            ]);
        }
    }

    public function list(Request $request)
    {
        $values = $request->value === "1" ? "0" : "1";
        $jabatan = null;

        if ($values === "1") {
            $jabatan = Position::where("deleted_at", null)->where("is_unit_usaha", $values)->get();
        } else {
            $index = $request->index;
            $jabatan = User::where("id_positions", "!=", "0")->where("id_positions", $index)->distinct('role_id')->get();
        }

        $option = "";
        foreach ($jabatan as $rows) {
            if ($values === "1") {
                $option .= '<option value="' . $rows->id . '">' . $rows->name . '</option>';
            } else {
                $option .= '<option value="' . $rows->role_id . '">' . $rows->role . '</option>';
            }
        }

        return $option;
    }

    public function listJson(Request $request)
    {
        $values = $request->value === "1" ? "0" : "1";
        $jabatan = null;

        if ($values === "1") {
            $jabatan = Position::where("deleted_at", null)->where("is_unit_usaha", $values)->get();
        } else {
            $index = $request->index;
            $jabatan = User::where("id_positions", "!=", "0")->where("id_positions", $index)->distinct('role_id')->get();
        }


        return response()->json($jabatan);
    }


    public function add(Request $request)
    {
        $rolePengadaan = new rolePengadaan();

        $rolePengadaan->id_user = 0;
        $rolePengadaan->id_unit_usaha = $request->pid_index_usaha;
        $rolePengadaan->id_role = $request->pt_id_role;
        $rolePengadaan->urutan = $request->input("cmb-prioritas");
        $rolePengadaan->menyetujui = $request->pid_menyetujui_unit_usaha;
        $rolePengadaan->rj = $request->pid_tolak_unit_usaha;
        $rolePengadaan->is_menyetujui = $request->pid_ttd_unit_usaha;
        $rolePengadaan->tipe_surat = ($request->selected_surat_tipe === null || $request->selected_surat_tipe === "") ? 0 : $request->selected_surat_tipe;
        $rolePengadaan->aktif = isset($request->pd_chk_aktif) ? true : false;

        $rolePengadaan->save();

        return response()->json([
            'message' => 'Role Pengadaan Berhasil Disimpan!',
            'redirectUrl' => route('detailUsaha', ['index' => $request->pid_index_usaha]),
            'status' => 200
        ]);
    }

    public function roleSave(Request $request)
    {
        $pembayaran = new rolePembayaran();

        $pembayaran->id_user = 0;
        $pembayaran->id_unit_usaha = $request->pid_index_usaha;
        $pembayaran->id_role = $request->pt_id_role;
        $pembayaran->urutan = $request->input("pmb-cmb-prioritas");
        $pembayaran->is_menyetujui = $request->input("pmb_ttd_unit_usaha");
        $pembayaran->menyetujui = $request->input("pmb_menyetujui_unit_usaha");
        $pembayaran->rj = $request->input("pmb_tolak_unit_usaha");
        $pembayaran->aktif = isset($request->pd_chk_aktif) ? true : false;

        $pembayaran->save();

        return response()->json([
            'message' => 'Role Pengadaan Berhasil Disimpan!',
            'redirectUrl' => route('detailUsaha', ['index' => $request->pid_index_usaha]),
            'status' => 200
        ]);
    }

    public function save(Request $request)
    {
        $jabatan = Position::where("id", $request->role)->get();

        $users = new User();

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->id_positions = $request->role;
        $users->role = $request->name;

        $users->save();

        return view('dashboard.pages.users.index', compact('users'));
    }

    public function viewHolding(Request $request)
    {
        $jabatan = Position::where("is_unit_usaha", "1")->where("deleted_at", null)->get();;
        $users = User::where("id_positions", "0")->orderBy("id", "desc");
        $menu = Menu::where("is_active", 1)->get();

        if (isset($request->cari_nama)) {
            $users = $users->where("name", "like", "%" . $request->cari_nama . "%");
        }

        if (isset($request->email_nama)) {
            $users = $users->where("email", "like", "%" .  $request->email_nama . "%");
        }

        $users = $users->paginate(10);

        return view('dashboard.pages.holding.index', compact('users', 'jabatan', 'menu'));
    }

    public function saveJabatan(Request $request)
    {
        $jabatan = Position::where("id", $request->role)->first();
        $users = new User();

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->id_positions = 0;
        $users->role = $jabatan->name;
        $users->role_id = $jabatan->id;
        $users->is_verified = true;
        $users->reset_password_token = "-";
        $users->status = $request->chk_aktif === null ? 0 : $request->chk_aktif;
        $users->signature_url = "-";

        $users->save();

        // $menu = Menu::where("is_active", 1)->get();

        // foreach ($menu as $rows) {
        //     if ($request->input("chk_menus_" . $rows->id)) {
        //         $accMenu = new AccessMenu();
        //         $accMenu->id_jabatan = $request->acc_t_index;
        //         $accMenu->id_menu = $request->input("chk_menus_" . $rows->id);

        //         $accMenu->save();
        //     }
        // }

        return \Redirect::route('holding')->with('message', 'State saved correctly!!!');
    }

    public function saveJabatanHolding(Request $request)
    {
        $cekUser = User::where("email", $request->email)->count();

        if ($cekUser > 0) {
            return response()->json(['message' => 'Duplicate Email', 'redirectUrl' => route('holding'), 'status' => 500], 200);
        }

        $jabatan = Position::where("id", $request->role)->first();
        $users = new User();

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->id_positions = 0;
        $users->role = $jabatan->name;
        $users->role_id = $jabatan->id;
        $users->is_verified = true;
        $users->reset_password_token = "-";
        $users->status = $request->chk_aktif === null ? 0 : $request->chk_aktif;
        $users->signature_url = "-";


        if ($users->save()) {
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('holding'), 'status' => 200], 200);
            // return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State saved correctly!!!');
        } else {
            return response()->json(['message' => 'Terjadi Kesalahan', 'redirectUrl' => route('holding'), 'status' => 500], 200);
            //return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State error !!!');
        }
        //return \Redirect::route('holding')->with('message', 'State saved correctly!!!');
    }

    public function editJabatan(Request $request)
    {
        $jabatan = Position::where("id", $request->role)->first();
        $users = new User();

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->id_positions = 0;
        $users->role = $jabatan->name;
        $users->role_id = $jabatan->id;
        $users->is_verified = true;
        $users->reset_password_token = "-";
        $users->status = $request->chk_aktif === null ? 0 : $request->chk_aktif;
        $users->signature_url = "-";

        $users->save();
        return \Redirect::route('holding')->with('message', 'State saved correctly!!!');
    }

    public function editUserHolding(Request $request)
    {
        $jabatan = Position::where("id", $request->role_edit)->first();

        $update = User::where("id", $request->t_index_edit)->update(array(
            "name" => $request->name_edit,
            "email" => $request->email_edit,
            "role_id" => $request->role_edit,
            "role" => $jabatan->name,
            'status' => $request->chk_aktif_edit === null ? 0 : $request->chk_aktif_edit
        ));

        if ($update) {
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('holding'), 'status' => 200], 200);
            // return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State saved correctly!!!');
        } else {
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('holding'), 'status' => 200], 200);
            //return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State error !!!');
        }
    }

    public function saveSignatureHolding(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|string',
        ]);

        // Extract the base64 encoded image data
        $imageData = $request->input('image');
        $imageParts = explode(',', $imageData);

        if (count($imageParts) == 2) {
            // Decode the image
            $decodedData = base64_decode($imageParts[1]);

            // Generate a unique file name
            $fileName = 'signatures/' . uniqid('signature_', true) . '.png';

            // Save the file to the 'public' disk
            Storage::disk('public')->put($fileName, $decodedData);

            \Session::put("imageSaved", $fileName);

            User::where("id", $request->input('sig_t_index'))->update(array(
                'signature_url' => $fileName
            ));

            return response()->json(['message' => 'Signature saved successfully ! ', 'redirectUrl' => route('holding'), 'file' => $fileName], 200);
        }

        return response()->json(['message' => 'Invalid image data.'], 400);
    }

    public function editHolding(Request $request)
    {
        $jabatan = Position::where("id", $request->role_edit)->first();

        $update = User::where("id", $request->t_index_edit)->update(array(
            "name" => $request->name_edit,
            "email" => $request->email_edit,
            "role_id" => $request->role_edit,
            "role" => $jabatan->name,
            'status' => $request->chk_aktif_edit === null ? 0 : $request->chk_aktif_edit
        ));

        if ($update) {
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('holding'), 'status' => 200], 200);
            // return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State saved correctly!!!');
        } else {
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('holding'), 'status' => 200], 200);
            //return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State error !!!');
        }
    }
}
