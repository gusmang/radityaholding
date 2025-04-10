<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\Persetujuan;
use App\Models\pettyCash;
use App\Models\User;
use App\Models\Position;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();

        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        $pengadaan = null;
        $pembayaran = null;
        $surat = null;
        $unitUsaha = UnitUsaha::orderBy("id", "desc")->get();

        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            $pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->where("position", "!=", 0)->orderBy("id", "desc");
            $pembayaran = Persetujuan::where("deleted_at", null)->where("position", "1")->orderBy("id", "desc")->paginate(10);
            $surat = pettyCash::where("position", "1")->orderBy("id", "desc")->paginate(10);
        } else {
            $pengadaan = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->where("position", "!=", 0)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
            $pembayaran = Persetujuan::where("id_unit_usaha", Auth::user()->id_positions)->where("position", "1")->orderBy("id", "desc")->paginate(10);
            $surat = pettyCash::orderBy("id", "desc")->where("position", "1")->join("approval_doc_pettycash", "approval_doc_pettycash.id_surat", "petty_cashes.id")->where("petty_cashes.id_unit_usaha", Auth::user()->id_positions)->paginate(10);
        }

        $index = $_GET['index'];

        $submitted = (isset($_GET['cmb-laporan-periode']) && $_GET['cmb-laporan-periode'] === "submit") ? true : false;

        if ($submitted) {
            if ($_GET['cmb-laporan-periode'] == "1") {
                $sekarang = time();
                $satuBulanLalu = strtotime('-1 month', $sekarang);
                $periode = date('Y-m-d', $satuBulanLalu);
                $pengadaan = $pengadaan->where("tanggal", ">=", $periode)->where("tanggal", "<=", date("Y-m-d"));
                $pembayaran = $pembayaran->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
                $surat = $surat->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
            } else if ($_GET['cmb-laporan-periode'] == "2") {
                $sekarang = time();
                $satuBulanLalu = strtotime('-3 month', $sekarang);
                $periode = date('Y-m-d', $satuBulanLalu);
                $pengadaan = $pengadaan->where("tanggal", ">=", $periode)->where("tanggal", "<=", date("Y-m-d"));
                $pembayaran = $pembayaran->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
                $surat = $surat->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
            } else if ($_GET['cmb-laporan-periode'] == "3") {
                $sekarang = time();
                $satuBulanLalu = strtotime('-6 month', $sekarang);
                $periode = date('Y-m-d', $satuBulanLalu);
                $pengadaan = $pengadaan->where("tanggal", ">=", $periode)->where("tanggal", "<=", date("Y-m-d"));
                $pembayaran = $pembayaran->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
                $surat = $surat->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
            } else if ($_GET['cmb-laporan-periode'] == "4") {
                $sekarang = time();
                $satuBulanLalu = strtotime('-12 month', $sekarang);
                $periode = date('Y-m-d', $satuBulanLalu);
                $pengadaan = $pengadaan->where("tanggal", ">=", $periode)->where("tanggal", "<=", date("Y-m-d"));
                $pembayaran = $pembayaran->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
                $surat = $surat->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
            }
        }

        $pengadaan = $pengadaan->paginate(10);

        $pengadaanJml = $pengadaan->count();
        $pembayaranJml = $pembayaran->count();
        $suratJml = $surat->count();

        return view('dashboard.pages.laporan.index', compact('pengadaanJml', 'pembayaranJml', 'suratJml', 'users', 'unitUsaha', 'jabatan', 'pengadaan', 'pembayaran', 'surat'));
    }

    public function search(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();

        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        $pengadaan = null;
        $pembayaran = null;
        $surat = null;
        $unitUsaha = UnitUsaha::orderBy("id", "desc")->get();

        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            $pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->orderBy("id", "desc");
            $pembayaran = Persetujuan::where("deleted_at", null)->orderBy("id", "desc")->paginate(10);
            $surat = pettyCash::orderBy("id", "desc")->paginate(10);
        } else {
            $pengadaan = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
            $pembayaran = Persetujuan::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->paginate(10);
            $surat = pettyCash::orderBy("id", "desc")->join("approval_doc_pettycash", "approval_doc_pettycash.id_surat", "petty_cashes.id")->where("petty_cashes.id_unit_usaha", Auth::user()->id_positions)->paginate(10);
        }

        $pengadaan = $pengadaan->paginate(10);

        $data = [
            "users" => $users,
            "unitUsaha" => $unitUsaha,
            "jabatan" => $jabatan,
            "pengadaan" => $pengadaan,
            "pembayaran" => $pembayaran,
            "surat" => $surat
        ];

        return response()->json([$data]);
    }
}
