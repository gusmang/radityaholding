<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;

class SuratController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id","desc")->paginate(10);
        $jabatan = Position::where("deleted_at" , null)->get();
        $pengadaan = Pengadaan::orderBy("id" , "desc")->paginate(10);

        return view('dashboard.pages.surat.index' , compact('users' , 'jabatan','pengadaan'));
    }

}
