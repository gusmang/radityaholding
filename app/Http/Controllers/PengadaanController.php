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
use App\Models\historyPengadaan;
use App\Models\rolePembayaran;
use App\Models\rolePengadaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengadaanController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();
        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            $pengadaan = Pengadaan::where("tipe_surat", "!=", 2)->orderBy("id", "desc");
            //$pengadaan = Pengadaan::where("tipe_surat", "!=", 2)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->where("approval_doc_pengadaan.is_next", 1)->orderBy("id", "desc");
        } else {
            $pengadaan = Pengadaan::where("tipe_surat", "!=", 2)->where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc");
        }

        $roles = rolePengadaan::where("id_unit_usaha", Auth::user()->id_positions)->where("id_role", Auth::user()->role_id)->first();

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

        $pengadaan = $pengadaan->paginate(12);

        return view('dashboard.pages.pengadaan.index', compact('users', 'roles', 'jabatan', 'pengadaan'));
    }


    public function tolakPengadaan(Request $request)
    {
        $secretary = Position::where("name", "Sekretariat")->where("deleted_at", null)->first();

        $pengadaan = Pengadaan::where("id", $request->teks_dokumen_pengadaan_tolak)->first();

        $appr = approval_surat_pengadaan::where("id_surat", $request->teks_dokumen_pengadaan_tolak)->where("is_next", 1)->update([
            "is_next" => 0,
            "is_before" => 0,
            "status" => 0
        ]);

        if ($appr) {
            approval_surat_pengadaan::where("id_surat", $request->teks_dokumen_pengadaan_tolak)->where("id_jabatan", $secretary->id)->update([
                "is_next" => 1,
                "is_before" => 0,
                "status" => 0
            ]);
        }

        //Pengadaan::where("id", $request->teks_dokumen_pengadaan_tolak)->delete();
        Persetujuan::where("id_permohonan", $pengadaan->id)->delete();

        $historyPengadaan = new historyPengadaan();
        $historyPengadaan->title = "Surat telah ditolak oleh " . Auth::user()->role;
        $historyPengadaan->note = $request->verifikasi_berkas_tolak;
        $historyPengadaan->tanggal = date("Y-m-d");
        $historyPengadaan->id_surat_pengadaan =  $request->teks_dokumen_pengadaan_tolak;
        $historyPengadaan->id_user = Auth::user()->id;
        $historyPengadaan->id_jabatan = Auth::user()->role_id;


        if ($request->file("files") !== null) {
            $fileName = $request->file("files")->hashName();
            $path = $request->file("files")->storeAs('tolak', $fileName, 'public');

            $historyPengadaan->file = $path;
        }

        if ($historyPengadaan->save()) {
            Pengadaan::where("id", $request->teks_dokumen_pengadaan_tolak)->update(["next_verifikator" => "Sekretariat"]);

            return response()->json(['message' => 'Tolak Berkas Berhasil', "status" => 200], 200);
        } else {
            return response()->json(['message' => 'Tolak Berkas Gagal', "status" => 401], 401);
        }
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
        $roleApproval = rolePengadaan::where("id_role", Auth::user()->role_id)->first();

        $hasApproved = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $index)->where("status", 1)->get();
        $notApproved = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $index)->where("status", 0)->get();

        $historyPengadaan = historyPengadaan::join("positions", "positions.id", "history_pengadaan.id_jabatan")->select("history_pengadaan.*", "positions.name")->where("id_surat_pengadaan", $index)->get();
        // echo count($historyPengadaan);
        // die();
        $dokumen = DocPengadaan::where("id_surat", $index)->get();
        $docSurat = [];

        if (count($setuju) > 0) {
            $docSurat = dokumenPersetujuan::where("id_surat", $setuju[0]->id)->get();
        }

        $lastApprove = !isset($currentApproval->id_jabatan) ? $jabatan[count($jabatan) - 1]->id_jabatan : $currentApproval->id_jabatan;
        $approvalNext = !isset($currentApproval->name) ? $jabatan[count($jabatan) - 1]->name : $currentApproval->name;
        $diajukan = $jabatan[0]->name;

        return view('dashboard.pages.pengadaan_new.detail.sub.index', compact('historyPengadaan', 'docSurat', 'jabatanApproval', 'roleApproval', 'notApproved', 'hasApproved', 'jabatan', 'diajukan', 'approvalNext', 'beforeApproval', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
    }

    public function add(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();
        $lastNum = Pengadaan::orderBy("id", "desc")->first();
        $codeLast = str_pad(($lastNum->id + 1), 5, '0', STR_PAD_LEFT);

        return view('dashboard.pages.pengadaan.detail.index', compact('unitUsaha', 'codeLast'));
    }

    public function addLainnya(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();
        return view('dashboard.pages.lainnya.detail.index', compact('unitUsaha'));
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

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pettycash"]), 'status' => 200], 200);
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
        $invoice = $request->input("inp_invoice_no") . "/" . $request->input('inp_invoice');
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
                // Storage::disk('public')->put($fileName, $file);
                // $fileName = 'uploads/' . uniqid('signature_', true) . '.png';

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

    public function postPengadaan(Request $request)
    {
        $invoice = $request->input('inp_invoice');
        $pengadaanCount = Pengadaan::where("no_surat", $invoice)->count();

        if ($pengadaanCount > 0) {
            return response()->json([
                'message' => 'Duplikat No. Surat',
                'isDuplicate' => 1,
                'status' => 200
            ], 200);
        } else {
            // Access the values
            $tanggal = $request->input('cmbTglPengajuan');
            $tipeSurat = $request->input('cmbTipeSurat');
            $perihal = $request->input('inp_perihal');
            $nominal = $request->input('nominalPengajuan');
            $detail = $request->input('detailIsiSurat');

            $nominal = str_replace("Rp ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

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
                $tipeSurats = $tipeSurat == "3" ? 2 : 0;
                $ptCashRole = rolePengadaan::where("id_unit_usaha", Auth::user()->id_positions)->where("tipe_surat", $tipeSurats)->where("aktif", 1)->orderBy("urutan", "asc")->get();
                $pos = 1;

                $historyPengadaan = new historyPengadaan();
                $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                $historyPengadaan->note = "-";
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->id_surat_pengadaan =  $lastInsertedId;
                $historyPengadaan->id_user = Auth::user()->id;
                $historyPengadaan->id_jabatan = Auth::user()->role_id;

                $historyPengadaan->save();

                $posi = Position::where("id", $ptCashRole[1]->id_role)->first();
                Pengadaan::where("id", $lastInsertedId)->update(["next_verifikator" => $posi->name]);

                foreach ($ptCashRole as $rows) {
                    $approvalPettyCash = new approval_surat_pengadaan();

                    $userCurrent = Auth::user()->name;
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
                    $approvalPettyCash->title = $userCurrent;
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
                'message' => 'Input Pengadaan Berhasil Disimpan!',
                'isDuplicate' => 0,
                'status' => 200
            ]);
        }
    }

    public function postPengadaanLainnya(Request $request)
    {
        $tanggal = $request->input('cmbTglPengajuan');
        $tipeSurat = $request->input('cmbTipeSurat');
        $perihal = $request->input('inp_perihal');
        $nominal = $request->input('nominalPengajuan');
        $detail = $request->input('detailIsiSurat');
        $invoice = $request->input('inp_invoice');

        $pengadaan = new Pengadaan();
        $pengadaan->no_surat = $invoice;
        $pengadaan->title = $perihal;
        $pengadaan->id_unit_usaha = Auth::user()->id_positions;
        $pengadaan->unit_usaha = "Holding";
        $pengadaan->diajukan = Auth::user()->name;
        $pengadaan->tipe_surat = "2";
        $pengadaan->perihal = $perihal;
        $pengadaan->nominal_pengajuan = $nominal;
        $pengadaan->tanggal = $tanggal;
        $pengadaan->detail = $detail;

        $lastInsertedId = "";

        if ($pengadaan->save()) {
            $lastInsertedId = $pengadaan->id;
            $ptCashRole = rolePengadaan::where("tipe_surat", 1)->where("aktif", 1)->orderBy("urutan", "asc")->get();

            $posi = Position::where("id", $ptCashRole[1]->id_role)->first();
            Pengadaan::where("id", $lastInsertedId)->update(["next_verifikator" => $posi->name]);

            $pos = 1;
            foreach ($ptCashRole as $rows) {
                $approvalPettyCash = new approval_surat_pengadaan();

                $userCurrent = Auth::user()->name;
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
                $approvalPettyCash->title = $userCurrent;
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
            'message' => 'Input Pengadaan Berhasil Disimpan!',
            'status' => 200
        ]);
    }

    public function approvalPengadaan(Request $request)
    {
        $approved = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $request->t_index)->where("positions.aktif", "1")->get();

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
                    'note' => trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas)
                ));

                $users = User::where("role_id", $rows->id_jabatan)->first();

                $is_current = false;

                $historyPengadaan = new historyPengadaan();
                $historyPengadaan->title = "Surat telah disetujui oleh " . $rows->name;
                $historyPengadaan->note = trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : $request->verifikasi_berkas;
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->id_surat_pengadaan =  $request->t_index;
                $historyPengadaan->id_user = $users->id;
                $historyPengadaan->id_jabatan = Auth::user()->role_id;

                if ($request->file("files") !== null) {
                    $fileName = $request->file("files")->hashName();
                    $path = $request->file("files")->storeAs('note', $fileName, 'public');

                    $historyPengadaan->file = $path;
                }

                $historyPengadaan->save();

                $posi = Position::where("id", $rows->id_jabatan)->first();
                Pengadaan::where("id", $request->t_index)->update(["next_verifikator" => $posi->name]);
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
            'message' => 'Approval Berhasil Disimpan! ',
            'redirectUrl' => route('detailPengadaan', ['index' => $request->t_index]),
            'status' => 200
        ], 200);
    }

    public function approvalPengadaanSekretariat($index, $person, $idx, $idUsaha)
    {
        $lastInsertedId = $idx;
        $ptCashRole = rolePembayaran::where("id_unit_usaha", $idUsaha)->where("aktif", 1)->orderBy("urutan", "asc")->get();
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
        $invoice = $request->input('teksNomorSurat');
        $files = $request->file('docFile');
        $idPermohonan = $request->input("idPermohonan");

        $nominal = str_replace("Rp ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        $idPoss = Auth::user()->id_positions === "0" ? Auth::user()->role_id : Auth::user()->id_positions;

        $unitUsahaQ = Position::where("id", $idPoss)->first();

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

            $historyPengadaan = new historyPengadaan();
            $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->name;
            $historyPengadaan->note = "-";
            $historyPengadaan->tanggal = date("Y-m-d");
            $historyPengadaan->id_surat_pengadaan =  $pengadaan->id;
            $historyPengadaan->id_user = Auth::user()->id;
            $historyPengadaan->id_jabatan = Auth::user()->role_id;

            $historyPengadaan->save();

            $approved = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name")->where("id_surat", $idPermohonan)->get();

            $is_current = false;
            $jml = 0;

            foreach ($approved as $rows) {
                $jml++;
                if ($is_current ===  true) {
                    $posi = Position::where("id", $rows->id_jabatan)->first();
                    Pengadaan::where("id", $idPermohonan)->update(["next_verifikator" => $posi->name]);
                    break;
                }

                if (Auth::user()->role_id == $rows->id_jabatan) {
                    $is_current = true;
                }
            }
        }

        $id = $idPermohonan;
        $note = $request->verifikasi_berkas;

        $lastPos = Pengadaan::where("id", $id)->first();

        $lastInsertedId = $pengadaan->id;
        // Get the last inserted ID

        // Process files (example: save to storage)

        $lenFiles = $request->fileLength;

        for ($ins = 0; $ins < $lenFiles; $ins++) {
            $fileName = $request->file("files" . $ins)->hashName();
            // Save the file to the 'storage/app/public/uploads' directory with the random name
            $path = $request->file("files" . $ins)->storeAs('uploads/persetujuan', $fileName, 'public');
            \Log::info('File uploaded to:', ['path' => $path]);

            $dokumen = new dokumenPersetujuan();
            $dokumen->id_surat = $lastInsertedId;
            $dokumen->nama_dokumen = $fileName;

            $dokumen->save();
        }

        if ($saved === "1") {
            $approved = $this->approvalPengadaanSekretariat($request->t_index, $request->teks_person_approval_new,  $lastInsertedId, $lastPos->id_unit_usaha);

            if ($approved === 1) {
                return response()->json([
                    'message' => 'Input Persetujuan Berhasil Disimpan!',
                    'status' => 200
                ]);
            }
        }
    }
}
