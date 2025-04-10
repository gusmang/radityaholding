<?php

namespace App\Http\Controllers;

use App\Models\approval_surat_pembayaran;
use App\Models\User;
use App\Models\Position;
use App\Models\Pengadaan;
use App\Models\UnitUsaha;
use App\Models\Persetujuan;
use Illuminate\Http\Request;
use App\Models\ApprovalDocument;
use App\Models\ApprovalDocPembayaran;
use App\Models\DocPengadaan;
use App\Models\historyPembayaran;
use App\Models\Pembayaran;
use App\Models\rolePembayaran;
use App\Models\TipeSurat;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        $pengadaan = Pembayaran::where("deleted_at", null)->orderBy("id", "desc")->paginate(10);

        $roles = rolePembayaran::where("id_role", Auth::user()->role_id)->where("aktif", 1)->first();


        return view('dashboard.pages.pembayaran_new.index', compact('roles', 'users', 'jabatan', 'pengadaan'));
    }

    public function detailPembayaran(Request $request, $index)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        $approvalDoc = approvalDocument::where("id_surat", $index)->orderBy("id", "asc")->get();
        $pengadaan = Pembayaran::where("id", $index)->first();

        $user = User::where("id", $pengadaan->id_unit_usaha)->first();
        $setuju = Pembayaran::where("id", $index)->get();

        $jabatan = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->select("approval_doc_pembayarans.*", "positions.name")->where("id_surat", $index)->get();

        $currentApproval = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->where("id_surat", $index)->where("is_next", 1)->first();
        $beforeApproval = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->where("id_surat", $index)->where("is_before", 1)->first();

        $jabatanApproval = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->first();

        $hasApproved = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->select("approval_doc_pembayarans.*", "positions.name")->where("id_surat", $index)->where("status", 1)->get();
        $notApproved = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->select("approval_doc_pembayarans.*", "positions.name")->where("id_surat", $index)->where("status", 0)->get();

        $dokumen = DocPengadaan::where("id_surat", $index)->get();

        $lastApprove = !isset($currentApproval->id_jabatan) ? $jabatan[count($jabatan) - 1]->id_jabatan : $currentApproval->id_jabatan;
        $approvalNext = !isset($currentApproval->name) ? $jabatan[count($jabatan) - 1]->name : $currentApproval->name;
        $diajukan = $jabatan[0]->name;

        return view('dashboard.pages.pembayaran_new.detail.sub.index', compact('jabatanApproval', 'notApproved', 'hasApproved', 'jabatan', 'diajukan', 'approvalNext', 'beforeApproval', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
    }

    public function postPembayaran(Request $request)
    {
        // Access the values
        $tanggal = $request->input('cmbTglPengajuan');
        $tipeSurat = $request->input('cmbTipeSurat');
        $perihal = $request->input('inp_perihal');
        $nominal = $request->input('nominalPengajuan');
        $detail = $request->input('detailIsiSurat');
        $invoice = $request->input('inp_invoice');

        $pengadaanCount = Pembayaran::where("no_surat", $invoice)->count();

        if ($pengadaanCount > 0) {
            return response()->json([
                'message' => 'Duplikat No. Surat',
                'isDuplicate' => 1,
                'status' => 200
            ], 200);
        } else {

            //$unitUsahaQ = UnitUsaha::where("id", Auth::user()->id_positions)->first();
            $idPoss = Auth::user()->id_positions == "0" ? Auth::user()->role_id : Auth::user()->id_positions;

            $unitUsahaQ = Position::where("id", $idPoss)->first();

            $nominal = str_replace("Rp ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            $pengadaan = new Pembayaran();
            $pengadaan->id_persetujuan = 0;
            $pengadaan->no_surat = $invoice;
            $pengadaan->title = $perihal;
            $pengadaan->id_unit_usaha = Auth::user()->id_positions;
            $pengadaan->unit_usaha = $request->cmbUnitUsahaName;
            $pengadaan->diajukan = Auth::user()->name;
            $pengadaan->tipe_surat = $tipeSurat;
            $pengadaan->perihal = $perihal;
            $pengadaan->nominal_pengajuan = $nominal;
            $pengadaan->tanggal = $tanggal;
            $pengadaan->detail = $detail;

            $lastInsertedId = "";

            if ($pengadaan->save()) {
                $lastInsertedId = $pengadaan->id;
                $tipeSurats = $tipeSurat == "3" ? 2 : 0;
                //idPoss = Auth::user()->id_positions == "0" ? Auth::user()->role_id : Auth::user()->id_positions;

                $ptCashRole = rolePembayaran::where("aktif", 1)->orderBy("urutan", "asc")->get();

                $posi = Position::where("id", $ptCashRole[1]->id_role)->first();
                Pembayaran::where("id", $lastInsertedId)->update(["next_verifikator" => $posi->name]);

                $historyPengadaan = new historyPembayaran();
                $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                $historyPengadaan->note = "-";
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->id_surat_pembayaran =  $lastInsertedId;
                $historyPengadaan->id_user = Auth::user()->id;

                $historyPengadaan->save();

                if (Auth::user()->id_positions == "0") {
                    $ptCashRole = rolePembayaran::where("aktif", 1)->orderBy("urutan", "asc")->get();
                }
                $pos = 1;
                foreach ($ptCashRole as $rows) {
                    $approvalPettyCash = new approval_surat_pembayaran();

                    $userCurrent = Auth::user()->name;
                    $status = 0;
                    if ($pos === 1) {
                        $status = 1;
                        $titleSurat = "Surat Pembayaran Berhasil Dibuat";
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
                    $approvalPettyCash->title = $userCurrent;
                    $approvalPettyCash->is_next = $is_next;
                    $approvalPettyCash->next_id = 0;
                    if ($pos === 1) {
                        $approvalPettyCash->approved_by = Auth::user()->id;
                    } else {
                        $approvalPettyCash->approved_by = 0;
                    }

                    $approvalPettyCash->save();
                    $pos++;
                }
            }
        }

        $lenFiles = $request->fileLength;

        for ($ins = 0; $ins < $lenFiles; $ins++) {
            $fileName = $request->file("files" . $ins)->hashName();
            // Save the file to the 'storage/app/public/uploads' directory with the random name
            $path = $request->file("files" . $ins)->storeAs('uploads', $fileName, 'public');
            \Log::info('File uploaded to:', ['path' => $path]);

            $dokumen = new DocPengadaan();
            $dokumen->id_surat = $lastInsertedId;
            $dokumen->nama_dokumen = $fileName;

            $dokumen->save();
        }

        return response()->json([
            'message' => 'Data Pembayaran Berhasil Disimpan!',
            'status' => 200
        ]);
    }

    public function approvePembayaran(Request $request)
    {
        $approved = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $request->t_index)->get();

        $is_current = false;
        $jml = 0;

        $lastRole = $approved[count($approved) - 1]->id_jabatan;

        //$last = approval_surat_pety_cash::where("id", $rows->id)->orderBy("id", "desc")->first();
        foreach ($approved as $rows) {
            $jml++;
            if ($is_current ===  true) {
                approval_surat_pembayaran::where("id", $rows->id)->update(array(
                    "is_before" => 0,
                    "is_next" => 1,
                    'note' => trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas)
                ));

                $is_current = false;

                $historyPengadaan = new historyPembayaran();
                $historyPengadaan->title = "Surat telah disetujui oleh " . $rows->name;
                $historyPengadaan->note = trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas);
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->id_surat_pembayaran =  $request->t_index;
                $historyPengadaan->id_user = $rows->id_jabatan;

                $historyPengadaan->save();

                $posi = Position::where("id", $rows->id_jabatan)->first();
                Pembayaran::where("id", $request->t_index)->update(["next_verifikator" => $posi->name]);
                break;
            }
            if ($request->teks_person_approval_new == $rows->id_jabatan) {
                $is_current = true;

                approval_surat_pembayaran::where("id", $rows->id)->update(array(
                    "is_before" => 0
                ));

                approval_surat_pembayaran::where("id", $rows->id)->update(array(
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

    public function approvalPembayaranRoles(Request $request)
    {
        $approved = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->select("approval_doc_pembayarans.*", "positions.name")->where("id_surat", $request->t_index)->where("positions.aktif", "1")->get();

        $is_current = false;
        $jml = 0;

        $lastRole = $approved[count($approved) - 1]->id_jabatan;

        //$last = approval_surat_pety_cash::where("id", $rows->id)->orderBy("id", "desc")->first();
        foreach ($approved as $rows) {
            $jml++;
            if ($is_current ===  true) {
                approval_surat_pembayaran::where("id", $rows->id)->update(array(
                    "is_before" => 0,
                    "is_next" => 1,
                    'note' => $request->verifikasi_berkas
                ));

                $is_current = false;
                break;
            }
            if ($request->teks_person_approval_new == $rows->id_jabatan) {
                $is_current = true;

                approval_surat_pembayaran::where("id", $rows->id)->update(array(
                    "is_before" => 0
                ));

                approval_surat_pembayaran::where("id", $rows->id)->update(array(
                    "is_before" => 1,
                    "status" => 1,
                    "is_next" => 0,
                    "nama" => "Surat telah disetujui oleh " . $rows->name,
                    "approved_by" => Auth::user()->id
                ));
            }
        }

        if ($lastRole === Auth::user()->role_id) {
            Pembayaran::where("id", $request->t_index)->update(array(
                "position" => 1
            ));
        }

        return response()->json([
            'message' => 'Approval Berhasil Disimpan! ' . $lastRole . "===" . Auth::user()->role_id,
            'redirectUrl' => route('detailPembayaran', ['index' => $request->t_index]),
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
