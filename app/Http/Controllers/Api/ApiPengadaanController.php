<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengadaan;
use App\Models\Position;
use App\Models\rolePengadaan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ApiPengadaanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalSekarang = time(); // Timestamp sekarang
        $tanggalKemarin = strtotime('-3 days', $tanggalSekarang); // Kurangi 3 hari

        $maxDate = date('Y-m-d', $tanggalKemarin); // Output: tanggal 3 hari yang lalu
        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            $pengadaan = Pengadaan::select('pengadaan.id as pid', 'approval_doc_pengadaan.*', 'pengadaan.*')
                ->where("tipe_surat", "!=", 2)
                ->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")
                ->where("is_rejected", false)->where("position", 0)
                ->where('tanggal', '>', $maxDate)
                ->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)
                ->where("approval_doc_pengadaan.is_next", 1)
                ->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)
                ->orderBy("pengadaan.id", "desc");
        } else {
            $pengadaan = Pengadaan::select('pengadaan.id as pid', 'approval_doc_pengadaan.*', 'pengadaan.*')
                ->where("tipe_surat", "!=", 2)
                ->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")
                ->where("is_rejected", false)
                ->where("position", 0)
                ->where('tanggal', '>', $maxDate)
                ->where("id_unit_usaha", Auth::user()->id_positions)
                ->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)
                ->where("approval_doc_pengadaan.is_next", 1)
                ->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)
                ->orderBy("pengadaan.id", "desc");
        }

        $submitted = (isset($_GET['btn-submit-new']) && $_GET['btn-submit-new'] === "submit") ? true : false;

        if ($submitted) {
            if (!empty($_GET['search_surat'])) {
                $pengadaan = $pengadaan->where("no_surat", $_GET['search_surat']);
            }
            if (!empty($_GET['tanggal_surat'])) {
                $pengadaan = $pengadaan->where("tanggal", $_GET['tanggal_surat']);
            }
            if (!empty($_GET['status_surat'])) {
                if ($_GET['status_surat'] == "1") {
                    $pengadaan = $pengadaan->where("position", "!=", "0");
                } else {
                    $pengadaan = $pengadaan->where("position", "0");
                }
            }
        }

        $pengadaan = $pengadaan->paginate(10);

        return response()->json(["pengadaan" => $pengadaan]);
    }

    public function urgentRequest(Request $request)
    {
        $tanggalSekarang = time(); // Timestamp sekarang
        $tanggalKemarin = strtotime('-3 days', $tanggalSekarang); // Kurangi 3 hari

        $maxDate = date('Y-m-d', $tanggalKemarin); // Output: tanggal 3 hari yang lalu
        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            $pengadaan_urgent = Pengadaan::where("deleted_at", null)
                ->where("is_rejected", false)->where("position", 0)
                ->where('pengadaan.updated_at', '<=', $maxDate)
                ->orderBy("pengadaan.id", "desc")->paginate(12);
        } else {
            $pengadaan_urgent = Pengadaan::where("tipe_surat", "!=", 2)
                ->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")
                ->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)
                ->where("approval_doc_pengadaan.is_next", 1)
                ->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)
                ->where("is_rejected", false)->where("position", 0)
                ->where("id_unit_usaha", Auth::user()->id_positions)->where('pengadaan.updated_at', '<=', $maxDate)
                ->orderBy("pengadaan.id", "desc")->paginate(12);
        }

        $datas = "";

        foreach ($pengadaan_urgent as $row) {
            $datas .= '<div class="col-md-4 col-6 mt-4">
            <div class="col-md-12 col-12 card"
                style="min-height: 200px; border-radius: 15px;  overflow: hidden; margin: 0; padding:0;">
                <table style="height: 80px; border-bottom: 1px solid #DDDDDD;">
                    <tbody>
                        <td style="padding: 20px 10px 20px 30px;">
                            <i class="fa fa-users"></i>
                        </td>
                        <td style="padding: 20px 20px 20px 0;">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 400;"> Pengajuan
                                    ' . $row->no_surat . '
                                </h5>
                            </div>
    
                            <div class="mt-2">
                                <h5 style="font-size: 14px; font-weight: normal; letter-spacing: 2px">
                                    ' . $row->created_at . '
                                </h5>
                            </div>
                        </td>
                    </tbody>
                </table>
    
                <div style="padding: 10px 20px 20px 20px;">
                    <div class="mt-2">
                        <h5 style="font-size: 12px; font-weight: normal; letter-spacing: 2px">
                            ' . $row->no_surat . '
                        </h5>
                    </div>
    
                    <div class="mt-4">
                        <h5 style="font-size: 16px; font-weight: 500;"> ' . $row->title . ' </h5>
                    </div>
    
                    <div class="mt-2" style="height: 100px;">
                        <h5
                            style="font-size: 12px; font-weight: normal; line-height: 21px; letter-spacing: 2px">
                            ' . substr(strip_tags($row->detail), 0, 200) . ' ...
                        </h5>
                    </div>
                </div>
    
                <div style="border-top: 1px solid #DDDDDD; padding: 20px;">
                    <div class="col-md-12" style="margin:0; padding: 0 10px;">
                        <div class="row">
                            <div class="col-md-7" style="margin:0; padding: 0;">
                                <div> Nominal Pengajuan </div>
                                <div> Rp ' . app('App\Helpers\Str')->rupiah($row->nominal_pengajuan) . '
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-end" style="margin:0; padding: 0;">
                                <a href="' . route('detailPettyCash', ['index' => $row->id]) . '">
                                    <button class="btn btn-primary-outlined">
                                        Lihat Detail
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';

            if ($row->position == "0") {
                $datas .= '<div
                    style="height: 50px; display: flex; border-radius: 0 0 15px 15px; font-size: 14px; justify-content: center; align-items: center; color: #ffffff; width: 100%; border-top: 1px solid #DDDDDD; background: brown;">
                    <div style="margin-right: 10px;"> <i class="fa fa-clock-o" style="font-size: 18px;"></i>
                    </div>
                    <div style="text-align: center;">
                        Menunggu persetujuan <br /> <b> ( ' . $row->next_verifikator . ' )</b>
                    </div>
                </div>';
            } else {
                $datas .= '<div
                    style="height: 50px; display: flex; border-radius: 0 0 15px 15px; font-size: 14px; justify-content: center; align-items: center; color: #ffffff; width: 100%; border-top: 1px solid #DDDDDD; background: green;">
                    <div style="margin-right: 10px;"> <i class="fa fa-check-circle"
                            style="font-size: 18px;"></i> </div>
                    <div>
                        Dokumen berhasil terverifikasi
                    </div>
                </div>';
            }

            $datas .= '</div>
            </div>';
        }

        return response()->json(
            [
                "current_page" => $pengadaan_urgent->currentPage(),
                "last_page" => $pengadaan_urgent->lastPage(),
                "nextPageUrl" => $pengadaan_urgent->nextPageUrl(),
                "prevPageUrl" => $pengadaan_urgent->previousPageUrl(),
                "pengadaan_urgent" => $datas,
                "jmlData" => count($pengadaan_urgent)
            ]
        );
    }

    public function progressRequest(Request $request)
    {
        $tanggalSekarang = time(); // Timestamp sekarang
        $tanggalKemarin = strtotime('-3 days', $tanggalSekarang); // Kurangi 3 hari

        $maxDate = date('Y-m-d', $tanggalKemarin); // Output: tanggal 3 hari yang lalu
        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0") {
            $pengadaan = Pengadaan::select('pengadaan.id as pid', 'approval_doc_pengadaan.*', 'pengadaan.*')
                ->where("tipe_surat", "!=", 2)
                ->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")
                ->where("is_rejected", false)
                ->where("position", 0)
                ->where('pengadaan.updated_at', '>', $maxDate)
                ->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)
                ->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)
                ->orderBy("pengadaan.id", "desc");
        } else {
            $pengadaan = Pengadaan::select('pengadaan.id as pid', 'approval_doc_pengadaan.*', 'pengadaan.*')
                ->where("tipe_surat", "!=", 2)
                ->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")
                ->where("is_rejected", false)->where("position", 0)
                ->where("id_unit_usaha", Auth::user()->id_positions)
                ->where('pengadaan.updated_at', '>', $maxDate)
                ->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)
                ->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)
                ->orderBy("pengadaan.id", "desc");
        }

        if (isset($_GET["val"])) {
            if ($_GET["val"] == "2") {
                $pengadaan = $pengadaan->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1);
            }
        }

        $pengadaan = $pengadaan->paginate(12);

        $datas = "";

        foreach ($pengadaan as $row) {
            $datas .= '<div class="col-md-4 col-6 mt-4">
            <div class="col-md-12 col-12 card"
                style="min-height: 200px; border-radius: 15px;  overflow: hidden; margin: 0; padding:0;">
                <table style="height: 80px; border-bottom: 1px solid #DDDDDD;">
                    <tbody>
                        <td style="padding: 20px 10px 20px 30px;">
                            <i class="fa fa-users"></i>
                        </td>
                        <td style="padding: 20px 20px 20px 0;">
                            <div>
                                <h5 style="font-size: 18px; font-weight: 400;"> Pengajuan
                                    ' . $row->no_surat . '
                                </h5>
                            </div>
    
                            <div class="mt-2">
                                <h5 style="font-size: 14px; font-weight: normal; letter-spacing: 2px">
                                    ' . $row->created_at . '
                                </h5>
                            </div>
                        </td>
                    </tbody>
                </table>
    
                <div style="padding: 10px 20px 20px 20px;">
                    <div class="mt-2">
                        <h5 style="font-size: 12px; font-weight: normal; letter-spacing: 2px">
                            ' . $row->no_surat . '
                        </h5>
                    </div>
    
                    <div class="mt-4">
                        <h5 style="font-size: 16px; font-weight: 500;"> ' . $row->title . ' </h5>
                    </div>
    
                    <div class="mt-2" style="height: 100px;">
                        <h5
                            style="font-size: 12px; font-weight: normal; line-height: 21px; letter-spacing: 2px">
                            ' . substr(strip_tags($row->detail), 0, 200) . ' ...
                        </h5>
                    </div>
                </div>
    
                <div style="border-top: 1px solid #DDDDDD; padding: 20px;">
                    <div class="col-md-12" style="margin:0; padding: 0 10px;">
                        <div class="row">
                            <div class="col-md-7" style="margin:0; padding: 0;">
                                <div> Nominal Pengajuan </div>
                                <div> Rp ' . app('App\Helpers\Str')->rupiah($row->nominal_pengajuan) . '
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-end" style="margin:0; padding: 0;">
                                <a href="' . route('detailPettyCash', ['index' => $row->id]) . '">
                                    <button class="btn btn-primary-outlined">
                                        Lihat Detail
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';

            if ($row->position == "0") {
                $datas .= '<div
                    style="height: 50px; display: flex; border-radius: 0 0 15px 15px; font-size: 14px; justify-content: center; align-items: center; color: #ffffff; width: 100%; border-top: 1px solid #DDDDDD; background: brown;">
                    <div style="margin-right: 10px;"> <i class="fa fa-clock-o" style="font-size: 18px;"></i>
                    </div>
                    <div style="text-align: center;">
                        Menunggu persetujuan <br /> <b> ( ' . $row->next_verifikator . ' )</b>
                    </div>
                </div>';
            } else {
                $datas .= '<div
                    style="height: 50px; display: flex; border-radius: 0 0 15px 15px; font-size: 14px; justify-content: center; align-items: center; color: #ffffff; width: 100%; border-top: 1px solid #DDDDDD; background: green;">
                    <div style="margin-right: 10px;"> <i class="fa fa-check-circle"
                            style="font-size: 18px;"></i> </div>
                    <div>
                        Dokumen berhasil terverifikasi
                    </div>
                </div>';
            }

            $datas .= '</div>
            </div>';
        }

        return response()->json(
            [
                "current_page" => isset($pengadaan) ? $pengadaan->currentPage() : 0,
                "last_page" => isset($pengadaan) ? $pengadaan->lastPage() : 0,
                "nextPageUrl" => isset($pengadaan) ? $pengadaan->nextPageUrl() : "",
                "prevPageUrl" => isset($pengadaan) ? $pengadaan->previousPageUrl() : "",
                "pengadaan" => $datas,
                "jmlData" => count($pengadaan)
            ]
        );
    }
}
