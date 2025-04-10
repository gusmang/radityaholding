<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function getNotif(Request $request)
    {
        $pengadaan = Pengadaan::where("next_verifikator", Auth::user()->role)->orderBy("id", "desc")->limit(10)->get();

        $notif = "";
        foreach ($pengadaan as $row) {
            $notif .= '<li>
             <a href=' . url('dashboard/detail-pengadaan/' . $row->id) . '>
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
