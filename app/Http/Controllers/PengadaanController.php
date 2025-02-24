<?php

namespace App\Http\Controllers;

use App\Models\approval_surat_pembayaran;
use App\Models\approval_surat_pengadaan;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Position;
use App\Models\Pengadaan;
use App\Models\TipeSurat;
use App\Models\UnitUsaha;
use App\Models\Persetujuan;
use Illuminate\Http\Request;
use App\Models\ApprovalDocument;
use App\Models\DocPengadaan;
use App\Models\dokumenPersetujuan;
use App\Models\rolePembayaran;
use App\Models\rolePengadaan;
use Illuminate\Support\Facades\Auth;

class PengadaanController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        $pengadaan = Pengadaan::orderBy("id", "desc");

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

        return view('dashboard.pages.pengadaan.index', compact('users', 'jabatan', 'pengadaan'));
    }

    public function detailPengadaan(Request $request, $index)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        $approvalDoc = approvalDocument::where("id_surat", $index)->orderBy("id", "asc")->get();
        $pengadaan = Pengadaan::where("id", $index)->first();

        $user = User::where("id", $pengadaan->id_unit_usaha)->first();
        $setuju = Persetujuan::where("id_permohonan", $index)->get();
        

        $jabatan = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $index)->get();

        $currentApproval = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->where("id_surat", $index)->where("is_next", 1)->first();
        $beforeApproval = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->where("id_surat", $index)->where("is_before", 1)->first();

        $jabatanApproval = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->first();

        $hasApproved = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $index)->where("status", 1)->get();
        $notApproved = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $index)->where("status", 0)->get();

        $dokumen = DocPengadaan::where("id_surat", $index)->get();

        // echo $currentApproval->id_jabatan;
        // die();

        $lastApprove = !isset($currentApproval->id_jabatan) ? $jabatan[count($jabatan) - 1]->id_jabatan : $currentApproval->id_jabatan;
        $approvalNext = !isset($currentApproval->name) ? $jabatan[count($jabatan) - 1]->name : $currentApproval->name;
        $diajukan = $jabatan[0]->name;

        return view('dashboard.pages.pengadaan_new.detail.sub.index', compact('jabatanApproval', 'notApproved', 'hasApproved', 'jabatan', 'diajukan', 'approvalNext', 'beforeApproval', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
    }

    public function add(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();
        return view('dashboard.pages.pengadaan.detail.index', compact('unitUsaha'));
    }

    public function postPengadaanRole(Request $request)
    {
        $pettyCashes = new rolePengadaan();

        $pettyCashes->id_user = 0;
        $pettyCashes->id_unit_usaha = $request->pid_index_usaha;
        $pettyCashes->id_role = $request->pt_id_role;
        $pettyCashes->urutan = 0;
        $pettyCashes->aktif = $request->pd_chk_aktif;

        $pettyCashes->save();

        return response()->json([
            'message' => 'Role Pengadaan Berhasil Disimpan!',
            'redirectUrl' => route('detailUsaha', ['index' => $request->pt_id_usaha]),
            'status' => 200
        ]);
    }

    public function editPosPengadaan(Request $request)
    {
        $indexUsaha = $request->t_index_pembayaran;
        $roleCount = $request->t_jumlah_role_pengadaan;

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pettycash_" . $an);
            $posRole = $request->input("role_pettycash_" . $an);

            $valChecked = $request->input("checked_role_pettycash_" . $an);
            $stss = $request->input("scBiasa_role_pengadaan_" . $an);

            rolePengadaan::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "menyetujui" => 1,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        return response()->json(['message' => 'Update Role Success 23234234234234343', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pettycash"]), 'status' => 200], 200);
    }


    public function postPengadaan2(Request $request)
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
        //$users = User::where("id_positions" , $unitUsaha)->orderBy($tipe->alias , "asc")->first();

        $pengadaan = new Pengadaan();
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

        $pengadaan->save();

        // Get the last inserted ID
        $lastInsertedId = $pengadaan->id;
        // Process files (example: save to storage)
        if ($files) {
            foreach ($files as $file) {
                $fileName = $file->hashName();
                // Save the file to the 'storage/app/public/uploads' directory with the random name
                $path = $file->storeAs('uploads', $fileName, 'public');
                \Log::info('File uploaded to:', ['path' => $path]);

                $dokumen = new Dokumen();
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

    // public function postPengadaan(Request $request)
    // {
    //     // Access the values
    //     $tanggal = $request->input('cmbTglPengajuan');
    //     $tipeSurat = $request->input('cmbTipeSurat');
    //     $perihal = $request->input('inp_perihal');
    //     $nominal = $request->input('nominalPengajuan');
    //     $detail = $request->input('detailIsiSurat');
    //     $unitUsaha = $request->input('cmbUnitUsaha');
    //     $unitUsahaName = $request->input('cmbUnitUsahaName');
    //     $invoice = $request->input('inp_invoice');
    //     $files = $request->file('docFile');

    //     $tipe = TipeSurat::where("id", $tipeSurat)->first();

    //     $unitUsahaQ = UnitUsaha::where("id", Auth::user()->id_positions)->first();

    //     $pengadaan = new Pengadaan();
    //     $pengadaan->no_surat = $invoice;
    //     $pengadaan->title = $perihal;
    //     $pengadaan->id_unit_usaha = $unitUsaha;
    //     $pengadaan->unit_usaha = $unitUsahaQ->name;
    //     $pengadaan->diajukan = Auth::user()->name;
    //     $pengadaan->tipe_surat = $tipeSurat;
    //     $pengadaan->perihal = $perihal;
    //     $pengadaan->nominal_pengajuan = $nominal;
    //     $pengadaan->tanggal = $tanggal;
    //     $pengadaan->detail = $detail;

    //     $lastInsertedId = "";

    //     if ($pengadaan->save()) {
    //         $lastInsertedId = $pengadaan->id;
    //         $ptCashRole = rolePengadaan::where("id_unit_usaha", Auth::user()->id_positions)->where("aktif", 1)->get();
    //         $pos = 1;
    //         foreach ($ptCashRole as $rows) {
    //             $approvalPettyCash = new approval_surat_pengadaan();

    //             $userCurrent = User::where("id", $rows->id_role)->first();
    //             $status = 0;
    //             if ($pos === 1) {
    //                 $status = 1;
    //                 $titleSurat = "Surat Pengadaan Berhasil Dibuat";
    //             } else {
    //                 $titleSurat = "-";
    //             }

    //             $is_next = 0;

    //             if ($pos === 2) {
    //                 $is_next = 1;
    //             }

    //             $approvalPettyCash->nama = $titleSurat;
    //             $approvalPettyCash->id_surat = $lastInsertedId;
    //             $approvalPettyCash->id_jabatan = $rows->id_role;
    //             $approvalPettyCash->status = $status;
    //             $approvalPettyCash->note = "-";
    //             $approvalPettyCash->title = $userCurrent->name;
    //             $approvalPettyCash->is_next = $is_next;
    //             if ($pos === 1) {
    //                 $approvalPettyCash->approved_by = Auth::user()->id;
    //             } else {
    //                 $approvalPettyCash->approved_by = 0;
    //             }

    //             $approvalPettyCash->save();
    //             $pos++;
    //         }
    //     }

    //     if ($files) {
    //         foreach ($files as $file) {
    //             $fileName = $file->hashName();
    //             // Save the file to the 'storage/app/public/uploads' directory with the random name
    //             $path = $file->storeAs('uploads', $fileName, 'public');
    //             \Log::info('File uploaded to:', ['path' => $path]);

    //             $dokumen = new DocPettyCash();
    //             $dokumen->id_surat = $lastInsertedId;
    //             $dokumen->nama_dokumen = $fileName;

    //             $dokumen->save();
    //         }
    //     }

    //     // Return JSON response
    //     return response()->json([
    //         'message' => 'Input Pengadaan Berhasil Disimpan!',
    //         'status' => 200
    //     ]);
    // }

    public function postPengadaan(Request $request)
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

        $pengadaan = new Pengadaan();
        $pengadaan->no_surat = $invoice;
        $pengadaan->title = $perihal;
        $pengadaan->id_unit_usaha = Auth::user()->id_positions;
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
            $ptCashRole = rolePengadaan::where("id_unit_usaha", Auth::user()->id_positions)->where("tipe_surat", 0)->where("aktif", 1)->orderBy("urutan", "asc")->get();
            $pos = 1;
            foreach ($ptCashRole as $rows) {
                $approvalPettyCash = new approval_surat_pengadaan();

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

                $dokumen = new DocPengadaan();
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

    public function approvalPengadaan(Request $request)
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

    public function approvalPengadaanSekretariat($index, $person, $idx , $idUsaha)
    {
        $lastInsertedId = $idx;
        $ptCashRole = rolePembayaran::where("id_unit_usaha", $idUsaha)->where("aktif", 1)->orderBy("urutan", "asc")->get();
        $pos = 1;

        foreach ($ptCashRole as $rows) {
            $approvalPettyCash = new approval_surat_pembayaran();

            $userCurrent = User::where("id", $rows->id_role)->first();
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
            $approvalPettyCash->title = $userCurrent->name;
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

        $approved = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $index)->get();

        $is_current = false;
        $jml = 0;

        $lastRole = $approved[count($approved) - 1]->id_jabatan;

        foreach ($approved as $rows) {
            $jml++;
            if ($is_current ===  true) {
                approval_surat_pengadaan::where("id", $rows->id)->update(array(
                    "is_before" => 0,
                    "is_next" => 1,
                    'note' => "-"
                ));

                $is_current = false;
                break;
            }
            if ($person == $rows->id_jabatan) {
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
            Pengadaan::where("id", $index)->update(array(
                "position" => 1
            ));
        }

        return 1;
    }

    public function postPersetujuan(Request $request)
    {
        // Access the values
        $tanggal = $request->input('cmbTglPengajuan');
        $tipeSurat = $request->input('cmbTipeSurat');
        $perihal = $request->input('inp_perihal');
        $nominal = $request->input('nominalPengajuan');
        $detail = $request->input('detailIsiSurat');
        $unitUsaha = $request->input('cmbUnitUsaha');
        $unitUsahaName = $request->input('cmbUnitUsahaName');
        $invoice = $request->input('teksNomorSurat');
        $files = $request->file('docFile');
        $idPermohonan = $request->input("idPermohonan");

        $tipe = TipeSurat::where("id", $tipeSurat)->first();

        $idPoss = Auth::user()->id_positions === "0" ? Auth::user()->role_id : Auth::user()->id_positions;

        $unitUsahaQ = Position::where("id", $idPoss)->first();
        //$users = User::where("id_positions" , $unitUsaha)->orderBy($tipe->alias , "asc")->first();

        $pengadaan = new Persetujuan();
        $pengadaan->id_permohonan = $idPermohonan;
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

        $saved = "0";

        if ($pengadaan->save()) {
            $saved = "1";
        }

        $id = $idPermohonan;
        $note = $request->verifikasi_berkas;

        $lastPos = Pengadaan::where("id", $id)->first();

        // $update = Pengadaan::where("id", $id)->update(array(
        //     "position" => ($lastPos->position)
        // ));

        // if ($update) {
        //     $approval = new ApprovalDocument();
        //     $approval->nama = "Surat disetujui oleh " . Auth::user()->name . " ( " . Auth::user()->role . " ) ";
        //     $approval->note = "Surat Permohonan Disetujui";
        //     $approval->title = Auth::user()->name;
        //     $approval->id_jabatan = Auth::user()->role_id;
        //     $approval->next_id = $lastPos->position;
        //     $approval->id_surat = $id;
        //     $approval->status = 1;

        //     if ($approval->save()) {
        //         return response()->json(['message' => 'Update Approval Success', 'redirectUrl' => route('detailPengadaan', ['index' => $id]), 'status' => 200], 200);
        //     }
        // }

        // Get the last inserted ID
        $lastInsertedId = $pengadaan->id;
        // Process files (example: save to storage)

        if ($files) {
            foreach ($files as $file) {
                $fileName = $file->hashName();
                // Save the file to the 'storage/app/public/uploads' directory with the random name
                $path = $file->storeAs('uploads', $fileName, 'public');
                \Log::info('File uploaded to:', ['path' => $path]);

                $dokumen = new dokumenPersetujuan();
                $dokumen->id_surat = $lastInsertedId;
                $dokumen->nama_dokumen = $fileName;

                $dokumen->save();
            }
        }

        if ($saved === "1") {
            // Return JSON response
            $approved = $this->approvalPengadaanSekretariat($request->t_index, $request->teks_person_approval_new ,  $lastInsertedId , $lastPos->id_unit_usaha);

            if ($approved === 1) {
                return response()->json([
                    'message' => 'Input Persetujuan Berhasil Disimpan!',
                    'status' => 200
                ]);
            }
        }
    }
}
