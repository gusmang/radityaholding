<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengadaan;
use App\Models\Persetujuan;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Models\pettyCash;
use App\Models\UnitUsaha;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
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
            $pengadaan = Pengadaan::join("persetujuan", "persetujuan.id_permohonan", "pengadaan.id")->select("pengadaan.*", "persetujuan.no_surat as nomor_surat_persetujuan", "persetujuan.perihal as perihal_persetujuan", "persetujuan.created_at as tanggal_dibuat", "persetujuan.nominal_pengajuan as nominal_persetujuan")
                ->where("pengadaan.isPermohonan", '!=', 1)
                ->orderBy("pengadaan.id", "desc");
            $pembayaran = Pembayaran::where("deleted_at", null)->orderBy("id", "desc")->paginate(10);
            $surat = pettyCash::orderBy("petty_cashes.id", "desc")->paginate(10);
        } else {
            $pengadaan = Pengadaan::join("persetujuan", "persetujuan.id_permohonan", "pengadaan.id")->select(["pengadaan.*", "persetujuan.no_surat as nomor_surat_persetujuan", "persetujuan.perihal as perihal_persetujuan", "persetujuan.created_at as tanggal_dibuat", "persetujuan.nominal_pengajuan as nominal_persetujuan"])
                ->where("pengadaan.isPermohonan", '!=', 1)
                ->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")
                ->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)
                ->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)
                ->orderBy("pengadaan.id", "desc");
            $pembayaran = Pembayaran::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->paginate(10);
            $surat = pettyCash::orderBy("petty_cashes.id", "desc")->join("approval_doc_pettycash", "approval_doc_pettycash.id_surat", "petty_cashes.id")->where("petty_cashes.id_unit_usaha", Auth::user()->id_positions)->paginate(10);
        }

        $index = $_GET['index'];

        $submitted = (isset($_GET['btn-submit-new']) && $_GET['btn-submit-new'] === "submit") ? true : false;

        if ($submitted) {
            if (!empty($_GET['search_surat'])) {
                $pengadaan = $pengadaan->whereRaw("REPLACE(pengadaan.no_surat, '/', '') = ?", [str_replace("/", "", $_GET['search_surat'])]);
            }
            if (!empty($_GET['tanggal_surat'])) {
                $pengadaan = $pengadaan->where("pengadaan.tanggal", $_GET['tanggal_surat']);
            }
            if (!empty($_GET['unit_usaha'])) {
                $pengadaan = $pengadaan->where("pengadaan.id_unit_usaha", $_GET['unit_usaha']);
            }
            if ($_GET['status_surat'] == "0") {
                //    $pengadaan = $pengadaan->where("pengadaan.next_verifikator", Auth::user()->role);
            }
        }

        if (!isset($_GET['status_surat'])) {
            //  $pengadaan = $pengadaan->where("next_verifikator", Auth::user()->role);
        }

        $pengadaan = $pengadaan->paginate(10);
        //$pengadaan = $pengadaan->toSql();

        //echo $pengadaan;
        //dd($pengadaan->toSql(), $pengadaan->getBindings());

        return view('dashboard.pages.surat.index', compact('users', 'unitUsaha', 'jabatan', 'pengadaan', 'pembayaran', 'surat'));
    }

    public function getDataAll(Request $request)
    {
        $pengadaan = null;

        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            $pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->orderBy("id", "desc");
        } else {
            $pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
        }

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

        $rowJson = "";
        foreach ($pengadaan as $row) {
            $rowJson .= '<tr>
                <td> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></td>
                <td class="table-plus"><b>' . $row->no_surat . '</b><br /><span
                        style="color: #666666">' . app("App\Helpers\Date")->tanggal_waktu($row->created_at, false) . '</span>
                </td>
                <td>' . $row->perihal . '</td>
                <td>' . app("App\Helpers\Str")->rupiah($row->nominal_pengajuan) . '</td>
                <td>' . $row->unit_usaha . '</td>
                <td>
                    <a href="' . route("detailPengadaan", ["index" => $row->id]) . '"> 
                        <i class="fa fa-eye"></i> 
                    </a>
                </td>
            </tr>';
        }

        return response()->json([
            "data" => trim($rowJson),
            "status" => 200
        ]);
    }

    public function getDataAllPmb(Request $request)
    {
        $pembayaran = null;

        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            $pembayaran = Persetujuan::where("deleted_at", null)->orderBy("id", "desc");
        } else {
            $pembayaran = Persetujuan::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc");
        }

        //$index = $_GET['index'];

        $submitted = (isset($_GET['btn-submit-new']) && $_GET['btn-submit-new'] === "submit") ? true : false;

        if ($submitted) {
            if (!empty($_GET['search_surat'])) {
                $pembayaran = $pembayaran->where("no_surat", $_GET['search_surat']);
            }
            if (!empty($_GET['tanggal_surat'])) {
                $pembayaran = $pembayaran->where("tanggal", $_GET['tanggal_surat']);
            }
        }

        $pembayaran = $pembayaran->paginate(10);

        $rowJson = "";
        foreach ($pembayaran as $row) {
            $rowJson .= '<tr>
                <td> <input type="checkbox" name="chk_name" id="chk_name" style="transform: scale(1.5);" /></td>
                <td class="table-plus"><b>' . $row->no_surat . '</b><br /><span
                        style="color: #666666">' . app("App\Helpers\Date")->tanggal_waktu($row->created_at, false) . '</span>
                </td>
                <td>' . $row->perihal . '</td>
                <td>' . app("App\Helpers\Str")->rupiah($row->nominal_pengajuan) . '</td>
                <td>
                    -
                </td>
                <td>
                    <a href="' . route("detailPembayaran", ["index" => $row->id]) . '"> 
                        <i class="fa fa-eye"></i> 
                    </a>
                </td>
            </tr>';
        }

        return response()->json([
            "data" => trim($rowJson),
            "status" => 200
        ]);
    }
}
