<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokumen;
use App\Models\Position;
use App\Models\Pengadaan;
use App\Models\TipeSurat;
use App\Models\UnitUsaha;
use App\Models\Persetujuan;
use Illuminate\Http\Request;
use App\Models\ApprovalDocument;
use App\Models\dokumenPersetujuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;

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

        $jabatan = DB::table('users')
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

        return view('dashboard.pages.pengadaan.detail.sub.index', compact('jabatan', 'lastApprove', 'unitUsaha', 'dokumen', 'pengadaan', 'approvalDoc', 'setuju'));
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
            $approval = new ApprovalDocument();
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
        return view('dashboard.pages.pengadaan.detail.index', compact('unitUsaha'));
    }

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

        $unitUsahaQ = UnitUsaha::where("id", Auth::user()->id_positions)->first();
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

        $pengadaan->save();

        $id = $idPermohonan;
        $note = $request->verifikasi_berkas;

        $lastPos = Pengadaan::where("id", $id)->first();

        $update = Pengadaan::where("id", $id)->update(array(
            "position" => ($lastPos->position)
        ));

        if ($update) {
            $approval = new ApprovalDocument();
            $approval->nama = "Surat disetujui oleh " . $request->teks_branch_approval . " ( " . $request->teks_person_approval . " ) ";
            $approval->note = "Surat Permohonan Disetujui";
            $approval->title = $request->teks_person_approval;
            $approval->id_jabatan = Auth::user()->role_id;
            $approval->next_id = $lastPos->position;
            $approval->id_surat = $id;
            $approval->status = 1;

            if ($approval->save()) {
                return response()->json(['message' => 'Update Approval Success', 'redirectUrl' => route('detailPengadaan', ['index' => $id]), 'status' => 200], 200);
            }
        }

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

        // Return JSON response
        return response()->json([
            'message' => 'Input Persetujuan Berhasil Disimpan!',
            'status' => 200
        ]);
    }
}