<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\Persetujuan;
use App\Models\pettyCash;
use App\Models\Position;
use App\Models\UnitUsaha;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        $pengadaan = null;
        $pembayaran = null;
        $surat = null;
        $unitUsaha = UnitUsaha::orderBy("id", "desc")->get();

        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            $pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->where("position", 0)->orderBy("id", "desc");
            $pengadaan2 = Pengadaan::where("isPermohonan", '!=', 1)->where("position", "!=", 0)->orderBy("id", "desc");
            $gp_pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->where("position", 0)->orderBy("id", "desc");
            $gp_pengadaan2 = Pengadaan::where("isPermohonan", '!=', 1)->where("position", "!=", 0)->orderBy("id", "desc");

            $pembayaran = Persetujuan::where("deleted_at", null)->orderBy("id", "desc")->paginate(10);
            $surat = pettyCash::orderBy("id", "desc")->paginate(10);
        } else {
            $pengadaan = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->where("position", 0)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
            $pengadaan2 = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->where("position", "!=", 0)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
            $gp_pengadaan = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->where("position", 0)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
            $gp_pengadaan2 = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->where("position", "!=", 0)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");

            $pembayaran = Persetujuan::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->paginate(10);
            $surat = pettyCash::orderBy("id", "desc")->join("approval_doc_pettycash", "approval_doc_pettycash.id_surat", "petty_cashes.id")->where("petty_cashes.id_unit_usaha", Auth::user()->id_positions)->paginate(10);
        }

        $arr = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
        $valArr = [];
        $valArr2 = [];

        foreach ($arr as $bln) {
            $startDate = date("Y") . "-" . $bln . "-" . "01";
            $endDate = date("Y") . "-" . $bln . "-" . "31";
            if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
                $gp_pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->where("position", 0)->orderBy("id", "desc");
                $gp_pengadaan2 = Pengadaan::where("isPermohonan", '!=', 1)->where("position", "!=", 0)->orderBy("id", "desc");
            } else {
                $gp_pengadaan = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->where("position", 0)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
                $gp_pengadaan2 = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->where("position", "!=", 0)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
            }
            $gp_pengadaan = $gp_pengadaan->where("pengadaan.created_at", ">=", $startDate)->where("pengadaan.created_at", "<=", $endDate)->sum("nominal_pengajuan");
            $gp_pengadaan2 = $gp_pengadaan2->where("pengadaan.created_at", ">=", $startDate)->where("pengadaan.created_at", "<=", $endDate)->sum("nominal_pengajuan");

            array_push($valArr, $gp_pengadaan);
            array_push($valArr2, $gp_pengadaan2);
        }

        $jmlPengadaan = $pengadaan->count();
        $jmlPengadaanPmb = $pembayaran->count();
        $jmlPengadaanPty = $surat->count();

        $pengadaan = $pengadaan->sum('nominal_pengajuan');
        $pengadaan2 = $pengadaan2->sum('nominal_pengajuan');

        return view('dashboard.pages.dashboard.index', compact('valArr', 'valArr2', 'jmlPengadaan', 'jmlPengadaanPmb', 'jmlPengadaanPty', 'pengadaan', 'pengadaan2', 'pembayaran', 'surat'));
    }

    public function sendNotification()
    {
        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->withImage('https://firebase.google.com/images/social.png')
            ->withIcon('https://seeklogo.com/images/F/firebase-logo-402F407EE0-seeklogo.com.png')
            ->withSound('default')
            ->withClickAction('https://www.google.com')
            ->withPriority('high')
            ->withAdditionalData([
                'color' => '#rrggbb',
                'badge' => 0,
            ])
            ->sendNotification($this->deviceTokens);

        // Or
        return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendNotification($this->deviceTokens);
    }

    public function sendMessage(Request $request)
    {
        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->sendMessage($request->token);

        // Or
        return Larafirebase::fromArray(['title' => 'Test Title', 'body' => 'Test body'])->sendMessage($this->deviceTokens);
    }

    public function logout(Request $request)
    {
        \Auth::logout();

        // Optional: Invalidate session to ensure it’s cleared completely.
        $request->session()->invalidate();

        // Optional: Regenerate session token to prevent session fixation.
        $request->session()->regenerateToken();

        // Redirect the user to the login page or another page.
        return redirect('/login');
    }
}
