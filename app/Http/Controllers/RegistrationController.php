<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    //
    public function registration(Request $request)
    {
        $name = $request->input('inp_name');
        $email = strtolower($request->input('inp_email'));
        $unit_usaha = $request->input('cmb_unit_usaha');
        $password = bcrypt($request->input('inp_kata_sandi'));

        $users = new User();

        $users->name = $name;
        $users->email = $email;
        $users->password = $password;
        $users->id_positions = $unit_usaha;
        $users->role = $unit_usaha;
        $users->reset_password_token = "-";
        $users->is_verified = 0;

        if($users->save()){
            return response()->json(["status" => 200 , "message" => "Pendaftaran Berhasil ... Silakan tunggu verifikasi dari manager unit usaha lebih lanjut"]);
        }
        else{
            return response()->json(["status" => 500 , "message" => "Pendaftaran Gagal !"]);
        }
    }

    public function forgotPass(Request $request){
        $email = $request->inp_email;
        $dataUser = User::where("email" , $email)->first();

        $random = str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789");
        $urlReset = url("/password-reset?token=".$random);
    
        if(Mail::to($email)->send(new ForgotPassword($dataUser , $urlReset))){
            User::where("email" , $email)->update(array("reset_password_token" => $random));
            return response()->json(["status" => 200 , "message" => "Email telah dikirimkan !"]);
        }
        else{
            return response()->json(["status" => 500 , "message" => "Something Wrong !"]);
        }
    }

    

    public function resetPassword(Request $request){
        $dataCount = User::where("reset_password_token" , $request->token)->count();

        if($dataCount > 0){
            return view("dashboard.pages.login.resetPassword");
        }
    }

    public function resetPasswordPost(Request $request){
        $newPass = $request->inp_kata_sandi;

        $update = User::where("reset_password_token" , $request->reset_token)->update(array("password" => bcrypt($newPass)));

        if($update){
            return response()->json(["status" => 200 , "message" => "Password Berhasil direset ! Silakan login dengan password baru anda .."]);
        }
        else{
            return response()->json(["status" => 500 , "message" => "Terjadi Kesalahan !"]);
        }
    }
}
