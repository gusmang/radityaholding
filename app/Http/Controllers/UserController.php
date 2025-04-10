<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();

        return view('dashboard.pages.users.index', compact('users', 'jabatan'));
    }

    public function edit(Request $request)
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
            return \Redirect::route('detailUsaha', [$request->index_edit . "?tab=users"])->with('message', 'State saved correctly!!!');
        } else {
            return \Redirect::route('detailUsaha', [$request->index_edit . "?tab=users"])->with('message', 'State error !!!');
        }
    }

    public function resetPassword(Request $request)
    {
        $indexUsaha = $request->sig_rp_unit_usaha_edit;

        $update = User::where("id", $request->sig_rp_t_index)->update(array(
            "password" => Hash::make($request->sig_rp_new_pass)
        ));

        if ($update) {
            return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=users"]), 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Reset Password Error', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=users"]), 'status' => 500], 500);
        }
    }

    public function save(Request $request)
    {
        $jabatan = Position::where("id", $request->role)->first();
        $users = new User();

        $users->name = $request->name;
        $users->email = strtolower($request->email);
        $users->password = Hash::make($request->password);
        $users->id_positions = $request->t_unit_usaha;
        $users->role = $jabatan->name;
        $users->role_id = $jabatan->id;
        $users->is_verified = true;
        $users->reset_password_token = "-";
        $users->status = $request->chk_aktif_add === null ? 0 : $request->chk_aktif_add;
        $users->signature_url = "-";

        $users->save();

        //return redirect("detail-usaha/".$request->index."?tab=user");
        return \Redirect::route('detailUsaha', [$request->index . "?tab=users"])->with('message', 'State saved correctly!!!');
    }
}
