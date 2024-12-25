<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Menu;
use App\Models\User;
use App\Models\Position;
use App\Models\roleHolding;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JabatanController extends Controller
{
    public function index(Request $request){
        $position = Position::paginate(10);

        return view('dashboard.pages.jabatan.index' , compact('position'));
    }

    public function add(Request $request){
        $jabatan = Position::where("id" , $request->cmb_posisi)->first();

        $users = new User();

        $users->name = "-";
        $users->email = date("YmdHis").rand(00000,99999)."@email.com";
        $users->password = bcrypt($request->password);
        $users->id_positions = $request->pid_index_usaha;
        $users->role = $jabatan->name;
        $users->role_id = $jabatan->id;
        $users->role_status = $request->role_status;
        $users->is_verified = true;
        $users->reset_password_token = "-";
        $users->status = $request->pd_chk_aktif === null ? 0 : $request->pd_chk_aktif;
        $users->signature_url = "-";

        if($users->save()){
            return response()->json(['message' => 'Add Role Success' , 'redirectUrl' => route('detailUsaha', [$request->pid_index_usaha."?tab=pengadaan"]), 'status' => 200], 200);
        }
        else{
            return response()->json(['message' => 'Add Role Failed' , 'status' => 500], 500);
        }
    }

    public function save(Request $request){
        $jabatan = Position::where("id" , $request->role)->get();

        $users = new User();

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->id_positions = $request->role;
        $users->role = $request->name;

        $users->save();

        return view('dashboard.pages.users.index' , compact('users'));
    }

    public function viewHolding(Request $request){
        $jabatan = Position::where("deleted_at" , null)->get();
        $users = User::where("id_positions" , "0")->orderBy("id","desc")->paginate(10);
        $menu = Menu::where("is_active" , 1)->get();

        return view('dashboard.pages.holding.index' , compact('users', 'jabatan', 'menu'));
    }

    public function saveJabatan(Request $request){
            $jabatan = Position::where("id" , $request->role)->first();
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

    public function editJabatan(Request $request){
        $jabatan = Position::where("id" , $request->role)->first();
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

    public function editUserHolding(Request $request){
        $jabatan = Position::where("id" , $request->role_edit)->first();

        $update = User::where("id" , $request->t_index_edit)->update(array(
            "name" => $request->name_edit,
            "email" => $request->email_edit,
            "role_id" => $request->role_edit,
            "role" => $jabatan->name,
            'status' => $request->chk_aktif_edit === null ? 0 : $request->chk_aktif_edit 
        ));

        if($update){
            return response()->json(['message' => 'Update Holding Success' , 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
           // return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State saved correctly!!!');
        }
        else{
            return response()->json(['message' => 'Update Holding Success' , 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
            //return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State error !!!');
        }
    }

    public function saveSignatureHolding(Request $request){
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

            \Session::put("imageSaved" , $fileName);

            User::where("id" , $request->input('sig_t_index'))->update(array(
                'signature_url' => $fileName
            ));

            return response()->json(['message' => 'Signature saved successfully ! ', 'redirectUrl' => route('viewHolding'), 'file' => $fileName], 200);
        }

        return response()->json(['message' => 'Invalid image data.'], 400);
    }

    public function editHolding(Request $request){
        $jabatan = Position::where("id" , $request->role_edit)->first();

        $update = User::where("id" , $request->t_index_edit)->update(array(
            "name" => $request->name_edit,
            "email" => $request->email_edit,
            "role_id" => $request->role_edit,
            "role" => $jabatan->name,
            'status' => $request->chk_aktif_edit === null ? 0 : $request->chk_aktif_edit 
        ));

        if($update){
            return response()->json(['message' => 'Update Holding Success' , 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
           // return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State saved correctly!!!');
        }
        else{
            return response()->json(['message' => 'Update Holding Success' , 'redirectUrl' => route('viewHolding'), 'status' => 200], 200);
            //return \Redirect::route('detailUsaha', [$request->index_edit."?tab=users"])->with('message', 'State error !!!');
        }
    }

}
