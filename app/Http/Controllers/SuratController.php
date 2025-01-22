<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Models\pettyCash;

class SuratController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        $pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->orderBy("id", "desc");
        $pembayaran = Pengadaan::where("isPermohonan", 1)->orderBy("id", "desc")->paginate(10);
        $surat = pettyCash::orderBy("id", "desc")->paginate(10);

        $index = $_GET['index'];

        $submitted = (isset($_GET['btn-submit-new']) && $_GET['btn-submit-new'] === "submit") ? true : false;

        if ($submitted) {
            if (!empty($_GET['search_surat'])) {
                $pengadaan = $pengadaan->where("no_surat", $_GET['search_surat']);
            }
            if (!empty($_GET['tanggal_surat'])) {
                $pengadaan = $pengadaan->where("tanggal", $_GET['tanggal_surat']);
            }
        }

        $pengadaan = $pengadaan->paginate(10);

        return view('dashboard.pages.surat.index', compact('users', 'jabatan', 'pengadaan', 'pembayaran', 'surat'));
    }
}