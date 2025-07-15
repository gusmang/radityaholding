<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengadaan;
use App\Models\pettyCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function getNotif(Request $request)
    {
        $routeName = "";
        $pengadaan = null;

        if ($request->tipe == "1" || !isset($request->tipe)) {
            $pengadaan = Pengadaan::where("next_verifikator", Auth::user()->role)->where('tipe_surat', '!=', 2)->orderBy("id", "desc")->limit(10)->get();
            $routeName = "detailPengadaan";
        } else if ($request->tipe == "2") {
            $pengadaan = Pembayaran::where("next_verifikator", Auth::user()->role)->orderBy("id", "desc")->limit(10)->get();
            $routeName = "detailPembayaran";
        } else if ($request->tipe == "3") {
            $pengadaan = pettyCash::where("next_verifikator", Auth::user()->role)->orderBy("id", "desc")->limit(10)->get();
            $routeName = "detailPettyCash";
        } else if ($request->tipe == "4") {
            $pengadaan = Pengadaan::where("next_verifikator", Auth::user()->role)->where('tipe_surat', 2)->orderBy("id", "desc")->limit(10)->get();
            $routeName = "detailLainnya";
        }

        $notif = "";
        foreach ($pengadaan as $row) {
            $notif .= '<li>
             <a href=' . route($routeName, ["index" => $row->id]) . '>
                 <img src=' . asset("vendors/images/letter.png") . ' alt="" style="height: 40px; width: 40px; object-fit: cover;" />
                 <h3>' . $row->no_surat . '</h3>
                 <p>
                     ' . $row->title . '
                 </p>
             </a>
         </li>';
        }

        return response()->json(["data" => $notif]);
    }
}
