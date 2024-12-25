<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Menu;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function index(Request $request){
        $position = Position::orderBy("id","desc")->paginate(10);
        $menu = Menu::where("is_active" , 1)->get();
        $profiles = User::where("id" , Auth::user()->id)->first();

        return view('dashboard.pages.profiles.component.detail' , compact('position' ,'menu','profiles'));
    }

    public function editProfiles(Request $request){
       $users =  User::where("id" , $request->tIndex)->update(
            array(
                "name" => $request->tName,
                "email" => $request->tEmail,
                "password" => Hash::make($request->tPassword)
            )
        );

        if($users){
            return response()->json(["status" => 200 , "message" => "Profile Berhasil DiUpdate", 'redirectUrl' => route('profile-edit')]);
        }
        else{
            return response()->json(["status" => 500 , "message" => "Something Wrong !", 'redirectUrl' => route('profile-edit')]);
        }
    }

    public function saveSignatureProfile(Request $request)
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

            Session::put("imageSaved" , $fileName);

            User::where("id" , $request->input('sig_t_index'))->update(array(
                'signature_url' => $fileName
            ));

            return response()->json(['message' => 'Signature saved successfully ! ', 'redirectUrl' => route('profile-edit'), 'file' => $fileName, 'status' => 200], 200);
        }

        return response()->json(['message' => 'Invalid image data.'], 400);
    }
}
