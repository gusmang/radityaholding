<?php

namespace App\Http\Controllers;

use App\Models\approval_surat_pety_cash;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Position;
use App\Models\Pengadaan;
use App\Models\pettyCash;
use App\Models\TipeSurat;
use App\Models\UnitUsaha;
use App\Models\Persetujuan;
use App\Models\DocPettyCash;
use Illuminate\Http\Request;
use App\Models\ApprovalDocument;
use App\Models\rolePettyCash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PettyCashController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        $pengadaan = pettyCash::orderBy("id", "desc")->paginate(10);

        return view('dashboard.pages.pettyCash.index', compact('users', 'jabatan', 'pengadaan'));
    }

    public function detailPengadaan(Request $request, $index)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        $approvalDoc = ApprovalDocument::where("id_surat", $index)->orderBy("id", "asc")->get();
        $pengadaan = Pengadaan::where("id", $index)->first();

        $user = User::where("id", $pengadaan->id_unit_usaha)->first();
        $setuju = Persetujuan::where("id_permohonan", $index)->get();

        $jabatan = DB::table('petty_cashes')
            ->where(function ($query) use ($user) {
                $query->where('id_positions',  0)
                    ->orWhere('id_positions',  $user->id_positions);
            })
            ->where(function ($query) use ($index) {
                $query->where('role_status',  1)
                    ->orWhere('id_positions', 0);
            })
            ->where('status', 1)
            ->orderBy('role_pengadaan', 'asc')
            ->get();

        $dokumen = Dokumen::where("id_surat", $index)->get();

        $lastApprove = "";
        $inc = 0;
        foreach ($jabatan as $rows) {
            if (($pengadaan->position + 1) == $inc) {
                if ($rows->id_positions == "0") {
                    $lastApprove = $rows->id;
                } else {
                    $lastApprove = $rows->role_id;
                }
                break;
            }
            $inc++;
        }

        return view('dashboard.pages.pettyCash.detail.sub.index', compact('jabatan', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
    }


    public function editPosPettyCash(Request $request)
    {
        $indexUsaha = $request->t_index_pembayaran;
        $roleCount = $request->t_jumlah_role;

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pettycash_" . $an);
            $posRole = $request->input("role_pettycash_" . $an);

            $valChecked = $request->input("checked_role_pettycash_" . $an);

            rolePettyCash::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        //echo $roleCount;

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pettycash"]), 'status' => 200], 200);
    }

    public function add(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();
        return view('dashboard.pages.pettyCash.detail.index', compact('unitUsaha'));
    }

    public function postPettyCashRole(Request $request)
    {
        $pettyCashes = new rolePettyCash();

        $pettyCashes->id_user = 0;
        $pettyCashes->id_unit_usaha = $request->pt_id_usaha;
        $pettyCashes->id_role = $request->pt_id_role;
        $pettyCashes->urutan = 0;

        $pettyCashes->save();

        return response()->json([
            'message' => 'Role Petty Cash Berhasil Disimpan!',
            'redirectUrl' => route('detailUsaha', ['index' => $request->pt_id_usaha]),
            'status' => 200
        ]);
    }

    public function postPettyCash(Request $request)
    {
        // Access the values
        $tanggal = $request->input('cmbTglPengajuan');
        $tipeSurat = $request->input('cmbTipeSurat');
        $perihal = $request->input('inp_perihal');
        $nominal = $request->input('nominalPengajuan');
        $detail = $request->input('detailIsiSurat');
        $unitUsaha = $request->input('cmbUnitUsaha');
        $unitUsahaName = $request->input('cmbUnitUsahaName');
        $invoice = $request->input('inp_invoice');
        $files = $request->file('docFile');

        $tipe = TipeSurat::where("id", $tipeSurat)->first();

        $unitUsahaQ = UnitUsaha::where("id", Auth::user()->id_positions)->first();

        $pengadaan = new pettyCash();
        $pengadaan->no_surat = $invoice;
        $pengadaan->title = $perihal;
        $pengadaan->id_unit_usaha = $unitUsaha;
        $pengadaan->unit_usaha = $unitUsahaQ->name;
        $pengadaan->diajukan = Auth::user()->name;
        $pengadaan->tipe_surat = $tipeSurat;
        $pengadaan->perihal = $perihal;
        $pengadaan->nominal_pengajuan = $nominal;
        $pengadaan->tanggal = $tanggal;
        $pengadaan->detail = $detail;

        $lastInsertedId = "";

        if ($pengadaan->save()) {
            $lastInsertedId = $pengadaan->id;
            $ptCashRole = rolePettyCash::where("id_unit_usaha", Auth::user()->id_positions)->where("aktif", 1)->get();
            $pos = 1;
            foreach ($ptCashRole as $rows) {
                $approvalPettyCash = new approval_surat_pety_cash();

                $userCurrent = User::where("id", $rows->id_role)->first();
                $status = 0;
                if ($pos === 1) {
                    $status = 1;
                    $titleSurat = "Surat Pengadaan Berhasil Dibuat";
                } else {
                    $titleSurat = "-";
                }

                $is_next = 0;

                if ($pos === 2) {
                    $is_next = 1;
                }

                $approvalPettyCash->nama = $titleSurat;
                $approvalPettyCash->id_surat = $lastInsertedId;
                $approvalPettyCash->id_jabatan = $rows->id_role;
                $approvalPettyCash->status = $status;
                $approvalPettyCash->note = "-";
                $approvalPettyCash->title = $userCurrent->name;
                $approvalPettyCash->is_next = $is_next;
                if ($pos === 1) {
                    $approvalPettyCash->approved_by = Auth::user()->id;
                } else {
                    $approvalPettyCash->approved_by = 0;
                }

                $approvalPettyCash->save();
                $pos++;
            }
        }

        if ($files) {
            foreach ($files as $file) {
                $fileName = $file->hashName();
                // Save the file to the 'storage/app/public/uploads' directory with the random name
                $path = $file->storeAs('uploads', $fileName, 'public');
                \Log::info('File uploaded to:', ['path' => $path]);

                $dokumen = new DocPettyCash();
                $dokumen->id_surat = $lastInsertedId;
                $dokumen->nama_dokumen = $fileName;

                $dokumen->save();
            }
        }

        // Return JSON response
        return response()->json([
            'message' => 'Input Pengadaan Berhasil Disimpan!',
            'status' => 200
        ]);
    }

    public function approvalPettyCash(Request $request)
    {
        $approved = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $request->t_index)->get();

        $is_current = false;
        $jml = 0;

        $lastRole = $approved[count($approved) - 1]->id_jabatan;

        //$last = approval_surat_pety_cash::where("id", $rows->id)->orderBy("id", "desc")->first();
        foreach ($approved as $rows) {
            $jml++;
            if ($is_current ===  true) {
                approval_surat_pety_cash::where("id", $rows->id)->update(array(
                    "is_before" => 0,
                    "is_next" => 1,
                    'note' => $request->verifikasi_berkas
                ));

                $is_current = false;
                break;
            }
            if ($request->teks_person_approval_new == $rows->id_jabatan) {
                $is_current = true;

                approval_surat_pety_cash::where("id", $rows->id)->update(array(
                    "is_before" => 0
                ));

                approval_surat_pety_cash::where("id", $rows->id)->update(array(
                    "is_before" => 1,
                    "status" => 1,
                    "is_next" => 0,
                    "nama" => "Surat telah disetujui oleh " . $rows->name,
                    "approved_by" => Auth::user()->id
                ));
            }
        }

        if ($lastRole === Auth::user()->role_id) {
            pettyCash::where("id", $request->t_index)->update(array(
                "position" => 1
            ));
        }

        return response()->json([
            'message' => 'Approval Berhasil Disimpan! ' . $lastRole . "===" . Auth::user()->role_id,
            'redirectUrl' => route('detailPettyCash', ['index' => $request->t_index]),
            'status' => 200
        ]);
    }

    public function detailPettyCash(Request $request, $index)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        $approvalDoc = approvalDocument::where("id_surat", $index)->orderBy("id", "asc")->get();
        $pengadaan = pettyCash::where("id", $index)->first();

        $user = User::where("id", $pengadaan->id_unit_usaha)->first();
        $setuju = Persetujuan::where("id_permohonan", $index)->get();

        $jabatan = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $index)->get();

        $currentApproval = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->where("id_surat", $index)->where("is_next", 1)->first();
        $beforeApproval = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->where("id_surat", $index)->where("is_before", 1)->first();

        $jabatanApproval = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->first();

        $hasApproved = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $index)->where("status", 1)->get();
        $notApproved = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $index)->where("status", 0)->get();

        $dokumen = DocPettyCash::where("id_surat", $index)->get();

        // echo $currentApproval->id_jabatan;
        // die();

        $lastApprove = !isset($currentApproval->id_jabatan) ? $jabatan[count($jabatan) - 1]->id_jabatan : $currentApproval->id_jabatan;
        $approvalNext = !isset($currentApproval->name) ? $jabatan[count($jabatan) - 1]->name : $currentApproval->name;
        $diajukan = $jabatan[0]->name;

        return view('dashboard.pages.pettyCash.detail.sub.index', compact('jabatanApproval', 'notApproved', 'hasApproved', 'jabatan', 'diajukan', 'approvalNext', 'beforeApproval', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
    }
}