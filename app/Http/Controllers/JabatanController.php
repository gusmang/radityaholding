<?php

namespace App\Http\Controllers;

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

    // public function editUserHolding(Request $request)
    // {
    //     $update = Position::where("id", $request->t_index_edit)->update(array(
    //         "name" => $request->name_edit,
    //         "note" => $request->email_edit,
    //         'aktif' => $request->chk_aktif_edit === null ? 0 : $request->chk_aktif_edit
    //     ));

    //     if ($update) {
    //         return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
    //         // return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State saved correctly!!!');
    //     } else {
    //         return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
    //         //return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State error !!!');
    //     }
    // }

    public function add(Request $request)
    {
        $pettyCashes = new rolePengadaan();

        $pettyCashes->id_user = 0;
        $pettyCashes->id_unit_usaha = $request->pid_index_usaha;
        $pettyCashes->id_role = $request->pt_id_role;
        $pettyCashes->urutan = 0;
        $pettyCashes->tipe_surat = ($request->selected_surat_tipe === null || $request->selected_surat_tipe === "") ? 0 : $request->selected_surat_tipe;
        $pettyCashes->aktif = $request->pd_chk_aktif;

        $pettyCashes->save();

        return response()->json([
            'message' => 'Role Pengadaan Berhasil Disimpan!',
            'redirectUrl' => route('detailUsaha', ['index' => $request->pid_index_usaha]),
            'status' => 200
        ]);
    }

    public function roleSave(Request $request)
    {
        $pettyCashes = new rolePembayaran();

        $pettyCashes->id_user = 0;
        $pettyCashes->id_unit_usaha = $request->pid_index_usaha;
        $pettyCashes->id_role = $request->pt_id_role;
        $pettyCashes->urutan = 0;
        $pettyCashes->aktif = $request->pd_chk_aktif;

        $pettyCashes->save();

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
        $jabatan = Position::where("deleted_at", null)->get();
        $users = User::where("id_positions", "0")->orderBy("id", "desc")->paginate(10);
        $menu = Menu::where("is_active", 1)->get();

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
        return \Redirect::route('viewHolding')->with('message', 'State saved correctly!!!');
    }

    public function saveJabatanHolding(Request $request)
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
        return \Redirect::route('viewHolding')->with('message', 'State saved correctly!!!');
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
        return \Redirect::route('viewHolding')->with('message', 'State saved correctly!!!');
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
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
            // return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State saved correctly!!!');
        } else {
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
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

            return response()->json(['message' => 'Signature saved successfully ! ', 'redirectUrl' => route('viewHolding'), 'file' => $fileName], 200);
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
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
            // return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State saved correctly!!!');
        } else {
            return response()->json(['message' => 'Update Holding Success', 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
            //return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State error !!!');
        }
    }
}
