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
        $pengadaan = Pengadaan::where("isPermohonan", 1)->orderBy("id", "desc")->paginate(10);

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
}
