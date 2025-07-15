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
use App\Models\historyPettyCash;
use App\Models\HistoryTransaction;
use App\Models\rolePettyCash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PettyCashController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();

        $tanggalSekarang = time(); // Timestamp sekarang
        $tanggalKemarin = strtotime('-3 days', $tanggalSekarang); // Kurangi 3 hari

        $maxDate = date('Y-m-d', $tanggalKemarin);

        $pengadaan  = "";
        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0") {
            $pengadaan = pettyCash::select("petty_cashes.*")->where("petty_cashes.deleted_at", null)
                // ->where("petty_cashes.is_rejected", false)
                // ->where("petty_cashes.position", 0)
                ->orderBy("petty_cashes.id", "desc");

            if ((int) Auth::user()->id_positions === 0) {
                $pengadaan = $pengadaan->join("approval_doc_pettycash", "approval_doc_pettycash.id_surat", "petty_cashes.id")->where("approval_doc_pettycash.id_jabatan", Auth::user()->role_id);
            }
        } else {
            $pengadaan = pettyCash::select("petty_cashes.*")->where("petty_cashes.deleted_at", null)
                ->join("approval_doc_pettycash", "approval_doc_pettycash.id_surat", "petty_cashes.id")
                ->where("id_unit_usaha", Auth::user()->id_positions)
                ->where("approval_doc_pettycash.id_jabatan", Auth::user()->role_id)
                ->where("is_rejected", false)
                //->where("position", 0)
                ->orderBy("petty_cashes.id", "desc");
        }
        if (isset($_GET['btn-submit-new'])) {
            if ($_GET['status_surat'] === "5") {
                $pengadaan = $pengadaan->where("petty_cashes.deleted_at", null)->where("is_rejected", true)->orderBy("id", "desc");
            } else if ($_GET['status_surat'] == "4") {
                $pengadaan = $pengadaan->where("petty_cashes.deleted_at", null)->where("is_rejected", false)->where("position", "!=", 0)->orderBy("id", "desc");
            } else if ($_GET['status_surat'] == "1") {
                $pengadaan = $pengadaan->where("petty_cashes.deleted_at", null)->where("is_rejected", false)->where("position", "=", 0)->whereDate('petty_cashes.tanggal', '<=', $maxDate)->orderBy("id", "desc");
            } else if ($_GET['status_surat'] == "2") {
                if ((int) Auth::user()->id_positions === -1) {
                    $pengadaan = $pengadaan->where("petty_cashes.deleted_at", null)->where("approval_doc_pettycash.is_next", 1)->where("is_rejected", false)->where("position", "=", 0)->join("approval_doc_pettycash", "approval_doc_pettycash.id_surat", "petty_cashes.id")->where("approval_doc_pettycash.id_jabatan", Auth::user()->role_id)->orderBy("id", "desc");
                } else {
                    $pengadaan = $pengadaan->where("petty_cashes.deleted_at", null)->where("approval_doc_pettycash.is_next", 1)->where("is_rejected", false)->where("position", "=", 0);
                }
            } else if ($_GET['status_surat'] == "3"  || !isset($_GET['status_surat']) || $_GET['status_surat'] == "") {
                $pengadaan = $pengadaan->where("petty_cashes.deleted_at", null)->where("is_rejected", false)->where("position", "=", 0)->orderBy("id", "desc");
            }

            if (isset($_GET['tanggal_surat']) && $_GET['tanggal_surat'] !== "") {
                if ($_GET['search_surat'] != "") {
                    $ex_created = explode(" - ", $_GET['tanggal_surat']);

                    $pengadaan = $pengadaan->whereDate("petty_cashes.created_at", ">=", str_replace("/", "-", $ex_created[0]))->whereDate("petty_cashes.created_at", "<=", str_replace("/", "-", $ex_created[1]));
                }
            }

            if (isset($_GET['search_surat'])) {
                if ($_GET['search_surat'] != "") {
                    $pengadaan = $pengadaan->where("no_surat", trim($_GET['search_surat']));
                }
            }
        }

        if (!isset($_GET['status_surat'])) {
            $pengadaan = $pengadaan->where("petty_cashes.deleted_at", null)->where("is_rejected", false)->where("position", "=", 0);
        }
        //$pengadaan = $pengadaan->whereTrim("no_surat", " Inv/001/PTSIDDA");

        $pengadaan = $pengadaan->paginate(app("App\Helpers\Setting")->paginatorLimit());

        $roles = rolePettyCash::where("id_role", Auth::user()->role_id)->where("aktif", 1)->first();
        //echo "tes " . $roles->urutan;
        //die();
        return view('dashboard.pages.pettyCash.index', compact('roles', 'users', 'jabatan', 'pengadaan'));
    }


    public function editPosPettyCash(Request $request)
    {
        $indexUsaha = $request->t_index_pembayaran;
        $roleCount = $request->t_jumlah_role;

        for ($an = 1; $an <= $roleCount; $an++) {
            $idRole = $request->input("id_role_pettycash_" . $an);
            $posRole = $request->input("role_pettycash_" . $an);

            $valChecked = $request->input("checked_role_pettycash_" . $an);
            $stss = $request->input("select_role_pettycash_" . $an);

            $menyetujuiNew = ($request->input("checked_role_is_mt_pengadaan_" . $an)) ? true : false;
            $rejectStatus = ($request->input("checked_role_rj_pengadaan_" . $an)) ? true : false;

            rolePettyCash::where("id", $idRole)->update(array(
                "urutan" => $posRole,
                "menyetujui" => $stss,
                "is_menyetujui" => $menyetujuiNew,
                "rj" => $rejectStatus,
                "aktif" => isset($valChecked) ? $valChecked : 0
            ));
        }

        return response()->json(['message' => 'Update Role Success', 'redirectUrl' => route('detailUsaha', [$indexUsaha . "?tab=pettycash"]), 'status' => 200], 200);
    }

    public function add(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();
        $lastNum = pettyCash::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->get();
        $codeLast = str_pad((count($lastNum) > 0 ? $lastNum[0]->urutan + 1 : 1), 5, '0', STR_PAD_LEFT);

        return view('dashboard.pages.pettyCash.detail.index', compact('unitUsaha', 'codeLast'));
    }

    public function postPettyCashRole(Request $request)
    {
        $pettyCashes = new rolePettyCash();

        $pettyCashes->id_user = 0;
        $pettyCashes->id_unit_usaha = $request->pt_id_usaha;
        $pettyCashes->id_role = $request->pt_id_role;
        $pettyCashes->urutan = $request->input("cmb-pty-prioritas");
        $pettyCashes->rj = $request->input("pty_tolak_unit_usaha");
        $pettyCashes->is_menyetujui = $request->input("pty_ttd_unit_usaha");
        $pettyCashes->menyetujui = $request->input("pty_menyetujui_unit_usaha");

        $pettyCashes->save();

        return response()->json([
            'message' => 'Role Petty Cash Berhasil Disimpan!',
            'redirectUrl' => route('detailUsaha', ['index' => $request->pt_id_usaha]),
            'status' => 200
        ]);
    }

    public function revisiPettyCash(Request $request, $uuid)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();
        // $lastNum = Pembayaran::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->get();
        // $codeLast = str_pad((count($lastNum) > 0 ? $lastNum[0]->urutan + 1 : 1), 5, '0', STR_PAD_LEFT);
        $pettycash = pettyCash::where("uuid", $uuid)->first();
        $codeSplit = explode("/", $pettycash->no_surat);
        $codeLast = $codeSplit[0];
        $codeSub = substr($pettycash->no_surat, (strlen($codeLast) + 1), strlen($pettycash->no_surat));

        $dokumen = DocPettyCash::where("id_surat", $pettycash->id)->get();

        $hisLast = historyPettyCash::where("id_surat_pettycash", $pettycash->id)->where("is_rejected", 1)->orderBy("id", "desc")->first();
        // echo $hisLast->note;
        // return;
        return view('dashboard.pages.pettyCash.detail.revisi', compact('unitUsaha', 'pettycash', 'codeLast', 'codeSub', 'dokumen', 'hisLast'));
    }

    public function hapusDocPettyCash(Request $request)
    {

        $rowDoc =  DocPettyCash::where("id", $request->id)->first();
        $filePath = public_path('storage/uploads/' . $rowDoc->nama_dokumen);
        if (file_exists($filePath)) {
            unlink($filePath);
            DocPettyCash::where("id", $request->id)->delete();

            return response()->json(["status" => 200, "id" => $rowDoc->id, "message" => "Data berhasil dihapus"]);
        } else {
            return response()->json(["status" => 500, "id" => $rowDoc->id, "message" => "Data gagal dihapus"]);
        }
    }

    public function updatePettyCash(Request $request)
    {
        DB::beginTransaction();

        try {
            $pembayaran = pettyCash::where("uuid", $request->hid_uuid_text)->first();
            $codeSplit = explode("/", $pembayaran->no_surat);
            $codeLast = $codeSplit[0];

            $tipeSurat = $request->input('cmbTipeSurat');
            $perihal = $request->input('inp_perihal');
            $nominal = $request->input('nominalPengajuan');
            $detail = $request->input('detailIsiSurat');
            //$invoice = $codeLast . "/" . $request->input("inp_invoice");
            $invoice = $request->input("inp_invoice");

            $nominal = str_replace("Rp ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            pettyCash::where("uuid", $request->hid_uuid_text)->update(
                array(
                    "no_surat" => $invoice,
                    "title" => $perihal,
                    "tipe_surat" => $tipeSurat,
                    "perihal" => $perihal,
                    "nominal_pengajuan" => $nominal,
                    "tanggal" => date("Y-m-d H:i:s"),
                    "detail" => $detail,
                    "is_rejected" => 0
                )
            );

            $ptCashRole = rolePettyCash::where("id_unit_usaha", Auth::user()->id_positions)->where("aktif", 1)->orderBy("urutan", "asc")->get();

            $posi = Position::where("id", $ptCashRole[1]->id_role)->first();
            pettyCash::where("uuid", $request->hid_uuid_text)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);

            $pmb = pettyCash::where("uuid", $request->hid_uuid_text)->first();

            $historyPengadaan = new historyPettyCash();
            $historyPengadaan->title = "Surat telah direvisi oleh " . Auth::user()->role;
            $historyPengadaan->note = "-";
            $historyPengadaan->tanggal = date("Y-m-d");
            $historyPengadaan->id_surat_pettycash =  $pmb->id;
            $historyPengadaan->id_user = Auth::user()->id;
            $historyPengadaan->id_jabatan = Auth::user()->role_id;

            if ($request->file("files") !== null) {
                $fileName = $request->file("files")->hashName();
                $path = $request->file("files")->storeAs('note', $fileName, 'public');

                $historyPengadaan->file = $path;
            }

            $historyPengadaan->save();

            if (Auth::user()->id_positions == "0") {
                $ptCashRole = rolePettyCash::where("aktif", 1)->orderBy("urutan", "asc")->get();
            }

            $appr_pmb = approval_surat_pety_cash::where("id_surat", $pmb->id)->get();

            approval_surat_pety_cash::where("id", $appr_pmb[0]->id)->update(
                array(
                    "is_next" => 0,
                    "status" => 1,
                    "approved_by" => Auth::user()->id
                )
            );

            approval_surat_pety_cash::where("id", $appr_pmb[1]->id)->update(
                array(
                    "is_next" => 1
                )
            );

            $lenFiles = $request->fileLength;

            for ($ins = 0; $ins < $lenFiles; $ins++) {
                $fileName = $request->file("files" . $ins)->hashName();
                // Save the file to the 'storage/app/public/uploads' directory with the random name
                $path = $request->file("files" . $ins)->storeAs('uploads', $fileName, 'public');
                \Log::info('File uploaded to:', ['path' => $path]);

                $dokumen = new DocPettyCash();
                $dokumen->id_surat = $pmb->id;;
                $dokumen->nama_dokumen = $fileName;

                $dokumen->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'Data PettyCash Berhasil Disimpan!',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            //if something goes wrong
            return response()->json(["message" => $e->getMessage(), "status" => 500]);
            DB::rollback();
        }
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
        //$unitUsahaName = $request->input('cmbUnitUsahaName');
        $lastNum = pettyCash::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->get();
        $codeLast = str_pad((count($lastNum) > 0 ? $lastNum[0]->urutan + 1 : 1), 5, '0', STR_PAD_LEFT);


        //$invoice = $codeLast . $request->input('inp_invoice');
        $invoice = $request->input('inp_invoice');

        $pengadaanCount = pettyCash::where("no_surat", $invoice)->count();

        if ($pengadaanCount > 0) {
            return response()->json([
                'message' => 'Duplikat No. Surat',
                'isDuplicate' => 1,
                'status' => 200
            ], 200);
        } else {
            $lastNum = pettyCash::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->get();

            $nominal = str_replace("Rp ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            $pengadaan = new pettyCash();
            $pengadaan->no_surat = $invoice;
            $pengadaan->uuid = Str::uuid();
            $pengadaan->urutan = count($lastNum) > 0 ? $lastNum[0]->urutan + 1 : 1;
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
                $ptCashRole = rolePettyCash::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("urutan", "asc")->where("aktif", 1)->get();
                $pos = 1;

                $posi = Position::where("id", $ptCashRole[1]->id_role)->first();
                pettyCash::where("id", $lastInsertedId)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);

                $historyPengadaan = new historyPettyCash();
                $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                $historyPengadaan->note = "-";
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->id_surat_pettycash =  $lastInsertedId;
                $historyPengadaan->id_user = Auth::user()->id;

                $historyPengadaan->save();

                foreach ($ptCashRole as $rows) {
                    $approvalPettyCash = new approval_surat_pety_cash();

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

                $dokumen = new DocPettyCash();
                $dokumen->id_surat = $lastInsertedId;
                $dokumen->nama_dokumen = $fileName;

                $dokumen->save();
            }

            // Return JSON response
            return response()->json([
                'message' => 'Input PettyCash Berhasil Disimpan!',
                'status' => 200
            ]);
        }
    }

    public function tolakPettyCash(Request $request)
    {
        $roles = approval_surat_pety_cash::where("id_surat", $request->teks_dokumen_pengadaan_tolak)->orderBy("id", "asc")->first();

        $appr = approval_surat_pety_cash::where("id_surat", $request->teks_dokumen_pengadaan_tolak)->update([
            "is_next" => 0,
            "is_before" => 0,
            "status" => 0
        ]);

        if ($appr) {
            approval_surat_pety_cash::where("id_surat", $request->teks_dokumen_pengadaan_tolak)->where("id_jabatan", $roles->id_jabatan)->update([
                "is_next" => 1,
                "is_before" => 0,
                "status" => 0
            ]);
        }

        $historyPengadaan = new historyPettyCash();
        $historyPengadaan->title = "Surat telah ditolak oleh " . Auth::user()->role;
        $historyPengadaan->note = $request->verifikasi_berkas_tolak;
        $historyPengadaan->tanggal = date("Y-m-d");
        $historyPengadaan->id_surat_pettycash =  $request->teks_dokumen_pengadaan_tolak;
        $historyPengadaan->id_user = Auth::user()->id;
        $historyPengadaan->id_jabatan = Auth::user()->role_id;
        $historyPengadaan->is_rejected = 1;

        if ($request->file("files") !== null) {
            $fileName = $request->file("files")->hashName();
            $path = $request->file("files")->storeAs('tolak', $fileName, 'public');

            $historyPengadaan->file = $path;
        }

        $poss = Position::where("id", $roles->id_jabatan)->first();

        pettyCash::where("id", $request->teks_dokumen_pengadaan_tolak)->update(
            ["is_rejected" => true, "next_verifikator" => $poss->name]
        );

        if ($historyPengadaan->save()) {
            return response()->json(['message' => 'Tolak Berkas Berhasil', "status" => 200], 200);
        } else {
            return response()->json(['message' => 'Tolak Berkas Gagal', "status" => 401], 401);
        }
    }

    public function revisi(Request $request)
    {
        $approved = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $request->t_index_rev)->where("positions.aktif", "1")->get();

        $lastRole = $approved[count($approved) - 1]->id_jabatan;

        approval_surat_pety_cash::where("id_surat", $request->t_index_rev)->update(array(
            "is_before" => 0,
            "is_next" => 0,
            'note' => "Revisi"
        ));

        approval_surat_pety_cash::where("id_surat", $request->t_index_rev)->where("id_jabatan", $approved[1]->id_jabatan)->update(array(
            "is_before" => 0,
            "is_next" => 1,
            'note' => trim(strip_tags($request->verifikasi_berkas_rev)) == "" ? "-" : strip_tags($request->verifikasi_berkas)
        ));


        $historyPengadaan = new historyPettyCash();
        $historyPengadaan->title = "Surat telah direvisi oleh " . Auth::user()->role;
        $historyPengadaan->note = "Revisi";
        $historyPengadaan->tanggal = date("Y-m-d");
        $historyPengadaan->id_surat_pettycash =  $request->t_index_rev;
        $historyPengadaan->id_user = Auth::user()->id;
        $historyPengadaan->id_jabatan = Auth::user()->role_id;

        if ($request->file("files") !== null) {
            $fileName = $request->file("files")->hashName();
            $path = $request->file("files")->storeAs('note', $fileName, 'public');

            $historyPengadaan->file = $path;
        }

        $historyPengadaan->save();

        $posi = Position::where("id", $approved[1]->id_jabatan)->first();
        pettyCash::where("id", $request->t_index_rev)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);

        $nominal = $request->rev_nominal_pettycash;

        $nominal = str_replace("Rp ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        pettyCash::where("id", $request->t_index_rev)->update(array(
            //"file" => 1,
            "is_rejected" => false,
            "perihal" => $request->rev_perihal_pettycash,
            "nominal_pengajuan" => $nominal,
            "tanggal" => date("Y-m-d"),
            "detail" => $request->detailIsiSurat
        ));

        return response()->json([
            'message' => 'Approval Berhasil Disimpan! ' . $lastRole . "===" . Auth::user()->role_id,
            'redirectUrl' => route('detailPettyCash', ['index' => $request->t_index_rev]),
            'status' => 200
        ]);
    }

    public function approvalPettyCash(Request $request)
    {
        DB::beginTransaction();

        try {
            $approved = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name")->where("id_surat", $request->t_index)->where("positions.aktif", "1")->get();

            $is_current = false;
            $jml = 0;

            $lastRole = $approved[count($approved) - 1]->id_jabatan;

            // echo count($approved);
            // return;

            //$last = approval_surat_pety_cash::where("id", $rows->id)->orderBy("id", "desc")->first();
            foreach ($approved as $rows) {
                $jml++;
                if ($is_current ===  true) {
                    approval_surat_pety_cash::where("id", $rows->id)->update(array(
                        "is_before" => 0,
                        "is_next" => 1,
                        'note' => trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas)
                    ));

                    $is_current = false;

                    $historyPengadaan = new historyPettyCash();
                    $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                    $historyPengadaan->note = trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas);
                    $historyPengadaan->tanggal = date("Y-m-d");
                    $historyPengadaan->id_surat_pettycash = $request->t_index;
                    $historyPengadaan->id_user = Auth::user()->id;
                    $historyPengadaan->id_jabatan = Auth::user()->role_id;

                    if ($request->file("files") !== null) {
                        $fileName = $request->file("files")->hashName();
                        $path = $request->file("files")->storeAs('note', $fileName, 'public');

                        $historyPengadaan->file = $path;
                    }

                    $historyPengadaan->save();

                    $posi = Position::where("id", $rows->id_jabatan)->first();
                    pettyCash::where("id", $request->t_index)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);
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
                        'title' => Auth::user()->name,
                        'note' => trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas),
                        "nama" => "Surat telah disetujui oleh " . Auth::user()->role,
                        "approved_by" => Auth::user()->id
                    ));
                }
            }

            if ($lastRole === Auth::user()->role_id) {
                $pty =  pettyCash::where("id", $request->t_index)->first();
                $idUnitUsaha = $pty->id_unit_usaha;
                $units = unitUsaha::where("id", $idUnitUsaha)->first();

                $lastBalance = $units->limit_petty_cash + $pty->nominal_pengajuan;

                $pettyCashes = pettyCash::where("id", $request->t_index)->first();

                $jabatan_id = Auth::user()->role_id;

                if (Auth::user()->id_positions != 0) {
                    $jabatan_id = Auth::user()->id_positions;
                }

                $historyPengadaan = new historyPettyCash();
                $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                $historyPengadaan->note = trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas);
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->note = "-";
                $historyPengadaan->id_surat_pettycash = $request->t_index;
                $historyPengadaan->id_user = $rows->id_jabatan;
                $historyPengadaan->id_jabatan = $jabatan_id;

                if ($request->file("files") !== null) {
                    $fileName = $request->file("files")->hashName();
                    $path = $request->file("files")->storeAs('note', $fileName, 'public');

                    $historyPengadaan->file = $path;
                }

                $historyPengadaan->save();

                $historyTrans = new HistoryTransaction();
                $historyTrans->id_surat = $request->t_index;
                $historyTrans->id_unit_usaha = $pettyCashes->id_unit_usaha;
                $historyTrans->nominal = $pty->nominal_pengajuan;
                $historyTrans->keterangan = "PettyCash ";
                $historyTrans->is_pengeluaran = 0;
                $historyTrans->tipe_surat = "Pengadaan";
                $historyTrans->kategori_surat = "-";

                $historyTrans->save();

                unitUsaha::where("id", $idUnitUsaha)->update(array(
                    "limit_petty_cash" => $lastBalance
                ));

                pettyCash::where("id", $request->t_index)->update(array(
                    "position" => 1
                ));
            }

            DB::commit();

            return response()->json([
                'message' => 'Approval Berhasil Disimpan!',
                'redirectUrl' => route('detailPettyCash', ['index' => $request->t_index]),
                'status' => 200
            ]);
        } catch (\Exception $e) {
            //if something goes wrong
            return response()->json(["message" => $e->getMessage(), "status" => 500]);
            DB::rollback();
        }
    }

    public function detailPettyCash(Request $request, $index)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        $approvalDoc = approvalDocument::where("id_surat", $index)->orderBy("id", "asc")->get();
        $pengadaan = pettyCash::where("id", $index)->first();

        if ($pengadaan && $pengadaan->id_unit_usaha !== null) {
            if (app("App\Helpers\Setting")->checkValidate($pengadaan->id_unit_usaha) === false) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $cnPengadaan = pettyCash::where("id", $index)->count();
        $approvalCount = approval_surat_pety_cash::where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->count();

        if ((int) Auth::user()->id_positions !== -1) {
            if ($cnPengadaan === 0 || $approvalCount === 0) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

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
        $historyPettyCash = historyPettyCash::where("id_surat_pettycash", $index)->get();

        $lastApprove = !isset($currentApproval->id_jabatan) ? $jabatan[count($jabatan) - 1]->id_jabatan : $currentApproval->id_jabatan;
        $approvalNext = !isset($currentApproval->name) ? $jabatan[count($jabatan) - 1]->name : $currentApproval->name;
        $diajukan = $jabatan[0]->name;
        $lastHistory = historyPettyCash::where("id_surat_pettycash", $index)->orderBy("id", "desc")->first();

        return view('dashboard.pages.pettyCash.detail.sub.index', compact('lastHistory', 'historyPettyCash', 'jabatanApproval', 'notApproved', 'hasApproved', 'jabatan', 'diajukan', 'approvalNext', 'beforeApproval', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
    }
}
