<?php

namespace App\Http\Controllers;

use App\Models\approval_surat_pembayaran;
use App\Models\User;
use App\Models\Position;
use App\Models\Pengadaan;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;
use App\Models\ApprovalDocument;
use App\Models\ApprovalDocPembayaran;
use App\Models\DocPembayaran;
use App\Models\historyPembayaran;
use App\Models\HistoryTransaction;
use App\Models\Pembayaran;
use App\Models\rolePembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    //
    public function index(Request $request)
    {
        $tanggalSekarang = time(); // Timestamp sekarang
        $tanggalKemarin = strtotime('-3 days', $tanggalSekarang); // Kurangi 3 hari

        $maxDate = date('Y-m-d', $tanggalKemarin);

        $users = User::orderBy("id", "desc")->paginate(10);
        $jabatan = Position::where("deleted_at", null)->get();

        // $pengadaan = Pembayaran::where("deleted_at", null)->where("is_rejected", false)->where("position", 0)->where(function ($query) use ($maxDate) {
        //     $query->where('position', "!=", 0)
        //         ->orWhere('updated_at', '<=', $maxDate);
        // })->orderBy("id", "desc")->paginate(10);
        $pengadaan  = "";

        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0") {
            $pengadaan = Pembayaran::select("pembayaran.*")->where("pembayaran.deleted_at", null)
                // ->where("is_rejected", false)
                // ->where("position", 0)
                ->orderBy("pembayaran.id", "desc");

            if (Auth::user()->id_positions == "0") {
                $pengadaan = $pengadaan->join("approval_doc_pembayarans", "approval_doc_pembayarans.id_surat", "pembayaran.id")->where("approval_doc_pembayarans.id_jabatan", Auth::user()->role_id);
            }
        } else {
            $pengadaan = Pembayaran::select("pembayaran.*")->where("pembayaran.deleted_at", null)
                ->join("approval_doc_pembayarans", "approval_doc_pembayarans.id_surat", "pembayaran.id")
                ->where("is_rejected", false)
                ->where("id_unit_usaha", Auth::user()->id_positions)
                ->where("approval_doc_pembayarans.id_jabatan", Auth::user()->role_id)
                //->where("position", 0)
                ->orderBy("pembayaran.id", "desc");
        }

        if (isset($_GET['btn-submit-new'])) {
            // die();
            if ($_GET['status_surat'] === "5") {
                $pengadaan = $pengadaan->where("pembayaran.deleted_at", null)->where("is_rejected", true);
            } else if ($_GET['status_surat'] == "4") {
                $pengadaan = $pengadaan->where("pembayaran.deleted_at", null)->where("is_rejected", false)->where("position", "!=", 0);
            } else if ($_GET['status_surat'] == "1") {
                $pengadaan = $pengadaan->where("pembayaran.deleted_at", null)->where("is_rejected", false)->where("position", "=", 0)->whereDate('tanggal', '<=', $maxDate);
            } else if ($_GET['status_surat'] == "2") {
                if ((int) Auth::user()->id_positions === -1) {
                    $pengadaan = $pengadaan->where("pembayaran.deleted_at", null)->where("approval_doc_pembayarans.is_next", 1)->where("is_rejected", false)->where("position", "!=", 0)->join("approval_doc_pembayaran", "approval_doc_pembayarans.id_surat", "pembayaran.id")->where("approval_doc_pembayarans.id_jabatan", Auth::user()->role_id);
                } else {
                    $pengadaan = $pengadaan->where("pembayaran.deleted_at", null)->where("approval_doc_pembayarans.is_next", 1)->where("is_rejected", false)->where("position", 0);
                }
            } else if ($_GET['status_surat'] == "3"  || !isset($_GET['status_surat']) || $_GET['status_surat'] == "") {
                //$pengadaan = Pembayaran::where("deleted_at", null)->where("is_rejected", false)->where("position", "=", 0)->where('pembayaran.tanggal', '`>=', $maxDate)->orderBy("id", "desc");
                $pengadaan = $pengadaan->where("pembayaran.deleted_at", null)->where("is_rejected", false)->where("position", "=", 0);
            }

            if (isset($_GET['tanggal_surat']) && $_GET['tanggal_surat'] !== "") {
                //if ($_GET['search_surat'] != "") {
                $ex_created = explode(" - ", $_GET['tanggal_surat']);

                $pengadaan = $pengadaan->whereBetween(DB::raw('DATE(pembayaran.created_at)'), [str_replace("/", "-", $ex_created[0]), str_replace("/", "-", $ex_created[1])]);
                //}
            }

            if (isset($_GET['search_surat'])) {
                if ($_GET['search_surat'] != "") {
                    $pengadaan = $pengadaan->where("no_surat", trim($_GET['search_surat']));
                }
            }
        }

        if (!isset($_GET['status_surat'])) {
            $pengadaan = $pengadaan->where("pembayaran.deleted_at", null)->where("is_rejected", false)->where("position", "=", 0);
        }
        //$pengadaan = $pengadaan->whereTrim("no_surat", " Inv/001/PTSIDDA");

        $pengadaan = $pengadaan->paginate(app("App\Helpers\Setting")->paginatorLimit());
        //$pengadaan_rj = Pembayaran::where("deleted_at", null)->where("is_rejected", true)->orderBy("id", "desc")->paginate(10);
        //$pengadaan_appr = Pembayaran::where("deleted_at", null)->where("is_rejected", false)->where("position", "!=", 0)->where('updated_at', '<=', $maxDate)->orderBy("id", "desc")->paginate(10);

        $roles = rolePembayaran::where("id_role", Auth::user()->role_id)->where("aktif", 1)->first();

        return view('dashboard.pages.pembayaran_new.index', compact('roles', 'users', 'jabatan', 'pengadaan'));
    }

    public function detailPembayaran(Request $request, $index)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();

        $approvalDoc = approvalDocument::where("id_surat", $index)->orderBy("id", "asc")->get();
        $pengadaan = Pembayaran::where("id", $index)->first();

        if ($pengadaan && $pengadaan->id_unit_usaha !== null) {
            if (app("App\Helpers\Setting")->checkValidate($pengadaan->id_unit_usaha) === false) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $cnPengadaan = Pembayaran::where("id", $index)->count();
        $approvalCount = approval_surat_pembayaran::where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->count();

        // if ($cnPengadaan === 0) {
        //     return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
        // }

        if ((int) Auth::user()->id_positions !== -1) {
            if ($cnPengadaan === 0 || $approvalCount === 0) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $user = User::where("id", $pengadaan->id_unit_usaha)->first();
        $setuju = Pembayaran::where("id", $index)->get();

        $jabatan = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->select("approval_doc_pembayarans.*", "positions.name")->where("id_surat", $index)->get();
        $currentApproval = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->where("id_surat", $index)->where("is_next", 1)->first();
        $beforeApproval = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->where("id_surat", $index)->where("is_before", 1)->first();

        $jabatanApproval = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->first();

        $hasApproved = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->select("approval_doc_pembayarans.*", "positions.name")->where("id_surat", $index)->where("status", 1)->get();
        $notApproved = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->select("approval_doc_pembayarans.*", "positions.name")->where("id_surat", $index)->where("status", 0)->get();

        $historyPembayaran = historyPembayaran::where("id_surat_pembayaran", $index)->get();

        $dokumen = DocPembayaran::where("id_surat", $index)->get();

        $lastApprove = !isset($currentApproval->id_jabatan) ? $jabatan[count($jabatan) - 1]->id_jabatan : $currentApproval->id_jabatan;
        $approvalNext = !isset($currentApproval->name) ? $jabatan[count($jabatan) - 1]->name : $currentApproval->name;
        $diajukan = $jabatan[0]->name;
        $lastHistory = historyPembayaran::where("id_surat_pembayaran", $index)->orderBy("id", "desc")->first();

        return view('dashboard.pages.pembayaran_new.detail.sub.index', compact('historyPembayaran', 'lastHistory', 'jabatanApproval', 'notApproved', 'hasApproved', 'jabatan', 'diajukan', 'approvalNext', 'beforeApproval', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
    }

    public function tolakPembayaran(Request $request)
    {
        $roles = approval_surat_pembayaran::where("id_surat", $request->teks_dokumen_pengadaan_tolak)->orderBy("id", "asc")->first();

        $appr = approval_surat_pembayaran::where("id_surat", $request->teks_dokumen_pengadaan_tolak)->update([
            "is_next" => 0,
            "is_before" => 0,
            "status" => 0
        ]);

        if ($appr) {
            approval_surat_pembayaran::where("id_surat", $request->teks_dokumen_pengadaan_tolak)->where("id_jabatan", $roles->id_jabatan)->update([
                "is_next" => 1,
                "is_before" => 0,
                "status" => 0
            ]);
        }


        $historyPengadaan = new historyPembayaran();
        $historyPengadaan->title = "Surat telah ditolak oleh " . Auth::user()->role;
        $historyPengadaan->note = $request->verifikasi_berkas_tolak === "" ? "-" : $request->verifikasi_berkas_tolak;
        $historyPengadaan->tanggal = date("Y-m-d");
        $historyPengadaan->id_surat_pembayaran =  $request->teks_dokumen_pengadaan_tolak;
        $historyPengadaan->id_user = Auth::user()->id;
        $historyPengadaan->id_jabatan = Auth::user()->role_id;
        $historyPengadaan->is_rejected = 1;

        if ($request->file("files") !== null) {
            $fileName = $request->file("files")->hashName();
            $path = $request->file("files")->storeAs('tolak', $fileName, 'public');

            $historyPengadaan->file = $path;
        }

        $poss = Position::where("id", $roles->id_jabatan)->first();

        Pembayaran::where("id", $request->teks_dokumen_pengadaan_tolak)->update(
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
        $approved = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")->select("approval_doc_pembayarans.*", "positions.name")->where("id_surat", $request->t_index_rev)->where("positions.aktif", "1")->get();

        $lastRole = $approved[count($approved) - 1]->id_jabatan;

        approval_surat_pembayaran::where("id_surat", $request->t_index_rev)->update(array(
            "is_before" => 0,
            "is_next" => 0,
            'note' => "Revisi"
        ));

        approval_surat_pembayaran::where("id_surat", $request->t_index_rev)->where("id_jabatan", $approved[1]->id_jabatan)->update(array(
            "is_before" => 0,
            "is_next" => 1,
            'note' => trim(strip_tags($request->verifikasi_berkas_rev)) == "" ? "-" : strip_tags($request->verifikasi_berkas)
        ));


        $historyPengadaan = new historyPembayaran();
        $historyPengadaan->title = "Surat telah direvisi oleh " . Auth::user()->role;
        $historyPengadaan->note = "Revisi";
        $historyPengadaan->tanggal = date("Y-m-d");
        $historyPengadaan->id_surat_pembayaran =  $request->t_index_rev;
        $historyPengadaan->id_user = Auth::user()->id;
        $historyPengadaan->id_jabatan = Auth::user()->role_id;

        if ($request->file("files") !== null) {
            $fileName = $request->file("files")->hashName();
            $path = $request->file("files")->storeAs('note', $fileName, 'public');

            $historyPengadaan->file = $path;
        }

        $historyPengadaan->save();

        $posi = Position::where("id", $approved[1]->id_jabatan)->first();
        Pembayaran::where("id", $request->t_index_rev)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);

        $nominal = $request->rev_nominal_pettycash;

        $nominal = str_replace("Rp ", "", $nominal);
        $nominal = str_replace(".", "", $nominal);

        Pembayaran::where("id", $request->t_index_rev)->update(array(
            //"file" => 1,
            "is_rejected" => 0,
            "perihal" => $request->rev_perihal_pettycash,
            "nominal_pengajuan" => $nominal,
            "tanggal" => date("Y-m-d"),
            "detail" => $request->detailIsiSurat
        ));

        return response()->json([
            'message' => 'Approval Berhasil Disimpan! ' . $lastRole . "===" . Auth::user()->role_id,
            'redirectUrl' => route('detailPembayaran', ['index' => $request->t_index_rev]),
            'status' => 200
        ]);
    }

    public function postPembayaran(Request $request)
    {
        $lastNum = Pembayaran::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->get();
        $codeLast = str_pad((count($lastNum) > 0 ? $lastNum[0]->urutan + 1 : 1), 5, '0', STR_PAD_LEFT);

        // Access the values
        $tanggal = $request->input('cmbTglPengajuan');
        $tipeSurat = $request->input('cmbTipeSurat');
        $perihal = $request->input('inp_perihal');
        $nominal = $request->input('nominalPengajuan');
        $detail = $request->input('detailIsiSurat');
        //$invoice = $codeLast . "/" . $request->input("inp_invoice");
        $invoice = $request->input("inp_invoice");

        $pengadaanCount = Pembayaran::where("no_surat", $invoice)->count();

        if ($pengadaanCount > 0) {
            return response()->json([
                'message' => 'Duplikat No. Surat',
                'isDuplicate' => 1,
                'status' => 200
            ], 200);
        } else {

            $lastNum = Pembayaran::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->get();

            $nominal = str_replace("Rp ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            $pengadaan = new Pembayaran();
            $pengadaan->id_persetujuan = 0;
            $pengadaan->uuid = Str::uuid();
            $pengadaan->urutan = count($lastNum) > 0 ? ($lastNum[0]->urutan + 1) : 1;
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

                $ptCashRole = rolePembayaran::where("id_unit_usaha", Auth::user()->id_positions)->where("aktif", 1)->orderBy("urutan", "asc")->get();

                $posi = Position::where("id", $ptCashRole[1]->id_role)->first();
                Pembayaran::where("id", $lastInsertedId)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);

                $historyPengadaan = new historyPembayaran();
                $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                $historyPengadaan->note = "-";
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->id_surat_pembayaran =  $lastInsertedId;
                $historyPengadaan->id_user = Auth::user()->id;
                $historyPengadaan->id_jabatan = Auth::user()->role_id;

                if ($request->file("files") !== null) {
                    $fileName = $request->file("files")->hashName();
                    $path = $request->file("files")->storeAs('note', $fileName, 'public');

                    $historyPengadaan->file = $path;
                }

                $historyPengadaan->save();

                if (Auth::user()->id_positions == "0") {
                    $ptCashRole = rolePembayaran::where("aktif", 1)->where("id_unit_usaha", Auth::user()->id_positions)->where("aktif", 1)->orderBy("urutan", "asc")->get();
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

            $dokumen = new DocPembayaran();
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
                $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                $historyPengadaan->note = trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas);
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->note = "-";
                $historyPengadaan->id_surat_pembayaran =  $request->t_index;
                $historyPengadaan->id_user = $rows->id_jabatan;

                $historyPengadaan->save();

                $posi = Position::where("id", $rows->id_jabatan)->first();
                Pembayaran::where("id", $request->t_index)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);
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
                    'note' => trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas),
                    "nama" => "Surat telah disetujui oleh " . Auth::user()->role,
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
        DB::beginTransaction();

        try {
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
                        'note' => !isset($request->verifikasi_berkas) ? "-" : $request->verifikasi_berkas
                    ));

                    $historyPengadaan = new historyPembayaran();
                    $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                    $historyPengadaan->note = trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas);
                    $historyPengadaan->tanggal = date("Y-m-d");
                    $historyPengadaan->id_surat_pembayaran =  $request->t_index;
                    $historyPengadaan->id_user = Auth::user()->id;

                    $historyPengadaan->save();

                    $is_current = false;

                    $posi = Position::where("id", $rows->id_jabatan)->first();
                    Pembayaran::where("id", $request->t_index)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);
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
                        'title' => Auth::user()->name,
                        'note' => trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas),
                        "nama" => "Surat telah disetujui oleh " . Auth::user()->role,
                        "approved_by" => Auth::user()->id
                    ));
                }
            }

            if ($lastRole === Auth::user()->role_id) {
                $pty =  Pembayaran::where("id", $request->t_index)->first();
                $idUnitUsaha = $pty->id_unit_usaha;
                $units = unitUsaha::where("id", $idUnitUsaha)->first();

                $lastBalance = $units->limit_petty_cash - $pty->nominal_pengajuan;

                $pengadaanCurrent = Pembayaran::where("id", $request->t_index)->orderBy("id", "desc")->first();


                $historyTrans = new HistoryTransaction();
                $historyTrans->id_surat = $request->t_index;
                $historyTrans->id_unit_usaha = $pengadaanCurrent->id_unit_usaha;
                $historyTrans->nominal = $pty->nominal_pengajuan;
                $historyTrans->keterangan = "Pembayaran ";
                $historyTrans->is_pengeluaran = 1;
                $historyTrans->tipe_surat = "Pembayaran";
                $historyTrans->kategori_surat = "";

                $historyTrans->save();

                $historyPengadaan = new historyPembayaran();
                $historyPengadaan->title = "Surat telah disetujui oleh " . Auth::user()->role;
                $historyPengadaan->note = trim(strip_tags($request->verifikasi_berkas)) == "" ? "-" : strip_tags($request->verifikasi_berkas);
                $historyPengadaan->tanggal = date("Y-m-d");
                $historyPengadaan->id_surat_pembayaran =  $request->t_index;
                $historyPengadaan->id_user = Auth::user()->id;

                if ($request->file("files") !== null) {
                    $fileName = $request->file("files")->hashName();
                    $path = $request->file("files")->storeAs('note', $fileName, 'public');

                    $historyPengadaan->file = $path;
                }

                $historyPengadaan->save();

                unitUsaha::where("id", $idUnitUsaha)->update(array(
                    "limit_petty_cash" => $lastBalance
                ));

                Pembayaran::where("id", $request->t_index)->update(array(
                    "position" => 1
                ));
            }

            DB::commit();

            return response()->json([
                'message' => 'Approval Berhasil Disimpan! ' . $lastRole . "===" . Auth::user()->role_id,
                'redirectUrl' => route('detailPembayaran', ['index' => $request->t_index]),
                'status' => 200
            ]);
        } catch (\Exception $e) {
            //if something goes wrong
            return response()->json(["message" => $e->getMessage(), "status" => 500]);
            DB::rollback();
        }
    }

    public function postPembayaranRole(Request $request)
    {
        $pembayaran = new rolePembayaran();

        // echo $request->input("pmb_menyetujui_unit_usaha");
        // die();

        $pembayaran->id_user = 0;
        $pembayaran->id_unit_usaha = $request->pid_index_usaha;
        $pembayaran->id_role = $request->pt_id_role;
        $pembayaran->urutan = $request->input("pmb-cmb-prioritas");
        $pembayaran->rj = $request->input("pmb_tolak_unit_usaha");
        $pembayaran->is_menyetujui = $request->input("pmb_ttd_unit_usaha");
        $pembayaran->menyetujui = $request->input("pmb_menyetujui_unit_usaha");
        $pembayaran->aktif = isset($request->pd_chk_aktif) ? true : false;

        $pembayaran->save();

        return response()->json([
            'message' => 'Role Pembayaran Berhasil Disimpan!',
            'redirectUrl' => route('detailUsaha', ['index' => $request->pid_index_usaha]),
            'status' => 200
        ]);
    }

    public function approvalDocument(Request $request)
    {
        $id = $request->teks_dokumen_pengadaan;
        $note = $request->verifikasi_berkas === "" ? "-" : $request->verifikasi_berkas;

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
        $lastNum = Pembayaran::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->get();
        $codeLast = str_pad((count($lastNum) > 0 ? $lastNum[0]->urutan + 1 : 1), 5, '0', STR_PAD_LEFT);

        return view('dashboard.pages.pembayaran_new.detail.index', compact('unitUsaha', 'codeLast'));
    }

    public function revisiPembayaran(Request $request, $uuid)
    {
        $unitUsaha = UnitUsaha::orderBy("name", "asc")->get();
        // $lastNum = Pembayaran::where("id_unit_usaha", Auth::user()->id_positions)->orderBy("id", "desc")->get();
        // $codeLast = str_pad((count($lastNum) > 0 ? $lastNum[0]->urutan + 1 : 1), 5, '0', STR_PAD_LEFT);
        $pembayaran = Pembayaran::where("uuid", $uuid)->first();
        $codeSplit = explode("/", $pembayaran->no_surat);
        $codeLast = $codeSplit[0];
        $codeSub = substr($pembayaran->no_surat, (strlen($codeLast) + 1), strlen($pembayaran->no_surat));

        $dokumen = DocPembayaran::where("id_surat", $pembayaran->id)->get();

        // echo $pembayaran->id;
        // return;
        $hisLast = historyPembayaran::where("id_surat_pembayaran", $pembayaran->id)->where("is_rejected", 1)->orderBy("id", "desc")->first();

        return view('dashboard.pages.pembayaran_new.detail.revisi', compact('unitUsaha', 'pembayaran', 'codeLast', 'codeSub', 'dokumen', 'hisLast'));
    }

    public function hapusDocPembayaran(Request $request)
    {
        $rowDoc =  DocPembayaran::where("id", $request->id)->first();
        $filePath = public_path('storage/uploads/' . $rowDoc->nama_dokumen);
        if (file_exists($filePath)) {
            unlink($filePath);
            DocPembayaran::where("id", $request->id)->delete();

            return response()->json(["status" => 200, "id" => $rowDoc->id, "message" => "Data berhasil dihapus"]);
        } else {
            return response()->json(["status" => 500, "id" => $rowDoc->id, "message" => "Data gagal dihapus"]);
        }
    }

    public function updatePembayaran(Request $request)
    {
        DB::beginTransaction();

        try {
            $pembayaran = Pembayaran::where("uuid", $request->hid_uuid_text)->first();
            $codeSplit = explode("/", $pembayaran->no_surat);
            $codeLast = $codeSplit[0];

            $tanggal = $request->input('cmbTglPengajuan');
            $tipeSurat = $request->input('cmbTipeSurat');
            $perihal = $request->input('inp_perihal');
            $nominal = $request->input('nominalPengajuan');
            $detail = $request->input('detailIsiSurat');
            //$invoice = $codeLast .  $request->input("inp_invoice");
            $invoice = $request->input("inp_invoice");

            $nominal = str_replace("Rp ", "", $nominal);
            $nominal = str_replace(".", "", $nominal);

            Pembayaran::where("uuid", $request->hid_uuid_text)->update(
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

            $ptCashRole = rolePembayaran::where("id_unit_usaha", Auth::user()->id_positions)->where("aktif", 1)->orderBy("urutan", "asc")->get();

            $posi = Position::where("id", $ptCashRole[1]->id_role)->first();
            Pembayaran::where("uuid", $request->hid_uuid_text)->update(["next_verifikator" => $posi->name, "tanggal" => date("Y-m-d H:i:s")]);

            $pmb = Pembayaran::where("uuid", $request->hid_uuid_text)->first();

            $historyPengadaan = new historyPembayaran();
            $historyPengadaan->title = "Surat telah direvisi oleh " . Auth::user()->role;
            $historyPengadaan->note = "-";
            $historyPengadaan->tanggal = date("Y-m-d");
            $historyPengadaan->id_surat_pembayaran =  $pmb->id;
            $historyPengadaan->id_user = Auth::user()->id;
            $historyPengadaan->id_jabatan = Auth::user()->role_id;

            if ($request->file("files") !== null) {
                $fileName = $request->file("files")->hashName();
                $path = $request->file("files")->storeAs('note', $fileName, 'public');

                $historyPengadaan->file = $path;
            }

            $historyPengadaan->save();

            if (Auth::user()->id_positions == "0") {
                $ptCashRole = rolePembayaran::where("aktif", 1)->orderBy("urutan", "asc")->get();
            }

            $appr_pmb = approval_surat_pembayaran::where("id_surat", $pmb->id)->get();

            approval_surat_pembayaran::where("id", $appr_pmb[0]->id)->update(
                array(
                    "is_next" => 0,
                    "status" => 1,
                    "approved_by" => Auth::user()->id
                )
            );

            approval_surat_pembayaran::where("id", $appr_pmb[1]->id)->update(
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

                $dokumen = new DocPembayaran();
                $dokumen->id_surat = $pmb->id;;
                $dokumen->nama_dokumen = $fileName;

                $dokumen->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'Data Pembayaran Berhasil Disimpan!',
                'status' => 200
            ]);
        } catch (\Exception $e) {
            //if something goes wrong
            return response()->json(["message" => $e->getMessage(), "status" => 500]);
            DB::rollback();
        }
    }
}
