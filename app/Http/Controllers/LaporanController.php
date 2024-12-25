<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;

class LaporanController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id","desc")->paginate(10);
        $jabatan = Position::where("deleted_at" , null)->get();

        return view('dashboard.pages.laporan.index' , compact('users' , 'jabatan'));
    }

}
