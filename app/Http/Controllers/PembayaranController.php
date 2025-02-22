<?php

namespace App\Http\Controllers;

use App\Models\approval_surat_pety_cash;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Position;
use App\Models\Pengadaan;
use App\Models\UnitUsaha;
use App\Models\Persetujuan;
use Illuminate\Http\Request;
use App\Models\ApprovalDocument;
use Illuminate\Support\Facades\DB;
use App\Models\ApprovalDocPembayaran;
use App\Models\DocPettyCash;
use App\Models\pettyCash;
use App\Models\rolePembayaran;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        $pengadaan = Persetujuan::where("deleted_at", null)->orderBy("id", "desc")->paginate(10);

        return view('dashboard.pages.pembayaran_new.index', compact('users', 'jabatan', 'pengadaan'));
    }

    public function detailPembayaran(Request $request, $index)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        $approvalDoc = approvalDocument::where("id_surat", $index)->orderBy("id", "asc")->get();
        $pengadaan = Pengadaan::where("id", $index)->first();

        $user = User::where("id", $pengadaan->id_unit_usaha)->first();
        $setuju = Persetujuan::where("id_permohonan", $index)->get();

        $jabatan = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $index)->get();

        $currentApproval = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->where("id_surat", $index)->where("is_next", 1)->first();
        $beforeApproval = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->where("id_surat", $index)->where("is_before", 1)->first();

        $jabatanApproval = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->first();

        $hasApproved = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $index)->where("status", 1)->get();
        $notApproved = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $index)->where("status", 0)->get();

        $dokumen = DocPettyCash::where("id_surat", $index)->get();

        $lastApprove = !isset($currentApproval->id_jabatan) ? $jabatan[count($jabatan) - 1]->id_jabatan : $currentApproval->id_jabatan;
        $approvalNext = !isset($currentApproval->name) ? $jabatan[count($jabatan) - 1]->name : $currentApproval->name;
        $diajukan = $jabatan[0]->name;

        return view('dashboard.pages.pembayaran_new.detail.sub.index', compact('jabatanApproval', 'notApproved', 'hasApproved', 'jabatan', 'diajukan', 'approvalNext', 'beforeApproval', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
    }

    public function approvePembayaran(Request $request)
    {
        $approved = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $request->t_index)->get();

        $is_current = false;
        $jml = 0;

        $lastRole = $approved[count($approved) - 1]->id_jabatan;

        //$last = approval_surat_pety_cash::where("id", $rows->id)->orderBy("id", "desc")->first();
        foreach ($approved as $rows) {
            $jml++;
            if ($is_current ===  true) {
                approval_surat_pengadaan::where("id", $rows->id)->update(array(
                    "is_before" => 0,
                    "is_next" => 1,
                    'note' => $request->verifikasi_berkas
                ));

                $is_current = false;
                break;
            }
            if ($request->teks_person_approval_new == $rows->id_jabatan) {
                $is_current = true;

                approval_surat_pengadaan::where("id", $rows->id)->update(array(
                    "is_before" => 0
                ));

                approval_surat_pengadaan::where("id", $rows->id)->update(array(
                    "is_before" => 1,
                    "status" => 1,
                    "is_next" => 0,
                    "nama" => "Surat telah disetujui oleh " . $rows->name,
                    "approved_by" => Auth::user()->id
                ));
            }
        }

        if ($lastRole === Auth::user()->role_id) {
            Pengadaan::where("id", $request->t_index)->update(array(
                "position" => 1
            ));
        }

        return response()->json([
            'message' => 'Approval Berhasil Disimpan! ' . $lastRole . "===" . Auth::user()->role_id,
            'redirectUrl' => route('detailPengadaan', ['index' => $request->t_index]),
            'status' => 200
        ]);
    }

    public function postPembayaranRole(Request $request)
    {
        $pettyCashes = new rolePembayaran();

        $pettyCashes->id_user = 0;
        $pettyCashes->id_unit_usaha = $request->pid_index_usaha;
        $pettyCashes->id_role = $request->pt_id_role;
        $pettyCashes->urutan = 0;
        $pettyCashes->aktif = $request->pd_chk_aktif;

        $pettyCashes->save();

        return response()->json([
            'message' => 'Role Pembayaran Berhasil Disimpan!',
            'redirectUrl' => route('detailUsaha', ['index' => $request->pid_index_usaha]),
            'status' => 200
        ]);
    }

    public function approvalDocument(Request $request)
    {
        $id = $request->teks_dokumen_pengadaan;
        $note = $request->verifikasi_berkas;

        $lastPos = Pengadaan::where("id", $id)->first();

        $update = Pengadaan::where("id", $id)->update(array(
            "position" => ($lastPos->position) + 1
        ));

        $user = User::where("id", $request->t_login)->first();

        if ($update) {
            $approval = new ApprovalDocPembayaran();
            $approval->nama = "Surat disetujui oleh " . $request->teks_branch_approval . " ( " . $request->teks_person_approval . " ) ";
            $approval->note = $note;
            $approval->title = $request->teks_person_approval;
            $approval->id_jabatan = $user->role_id;
            $approval->id_surat = $id;
            $approval->next_id = $lastPos->position + 1;
            $approval->status = 1;

            if ($approval->save()) {
                return response()->json(['message' => 'Update Approval Success', 'redirectUrl' => route('detailPengadaan', ['index' => $id]), 'status' => 200], 200);
            }
        }
    }

    public function add(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();
        return view('dashboard.pages.pembayaran_new.detail.index', compact('unitUsaha'));
    }
}
