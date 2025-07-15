<?php

namespace App\Http\Controllers;

use App\Models\approval_surat_pembayaran;
use App\Models\approval_surat_pengadaan;
use App\Models\approval_surat_pety_cash;
use App\Models\DocPembayaran;
use App\Models\DocPengadaan;
use App\Models\DocPettyCash;
use App\Models\dokumenPersetujuan;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Pengadaan;
use App\Models\Persetujuan;
use App\Models\pettyCash;
use App\Models\rolePembayaran;
use App\Models\rolePengadaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;


class ReportPdfController extends Controller
{

    public function signature_new(Request $request)
    {
        return view("dashboard.pages.dashboard.canvas");
    }

    public function generatePDF(Request $request)
    {
        $data = [
            'title' => 'Laravel Dompdf Example',
            'date' => date('m/d/Y'),
            'signaturePath' => public_path('storage/' . \Session::get("imageSaved")),
        ];

        $pdf = PDF::loadView('pdf.sample', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream('sample.pdf'); // Stream in the browser
        // return $pdf->download('sample.pdf'); // Download directly
    }

    public function showPDF(Request $request, $index)
    {
        $approval_doc = Pengadaan::where("id", $index)->first();

        $pengadaan = Pengadaan::where("id", $index)->first();

        if ($pengadaan && $pengadaan->id_unit_usaha !== null) {
            if (app("App\Helpers\Setting")->checkValidate($pengadaan->id_unit_usaha) === false) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $cnPengadaan = Pengadaan::where("id", $index)->count();
        $approvalCount = approval_surat_pengadaan::where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->count();

        if ((int)Auth::user()->id_positions !== -1) {
            if ($cnPengadaan === 0 || $approvalCount === 0) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $jabatan = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $index)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 0)->where("role_pengadaan.id_unit_usaha", $pengadaan->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();

        $menyetujui = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")
            ->join("users", "users.id", "approval_doc_pengadaan.approved_by")
            ->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")
            ->select("approval_doc_pengadaan.*", "positions.name", "users.*")
            ->where("approval_doc_pengadaan.id_surat", $index)
            ->where("approval_doc_pengadaan.status", 1)
            ->where("role_pengadaan.menyetujui", 1)
            ->where("role_pengadaan.id_unit_usaha", $pengadaan->id_unit_usaha)
            ->where("role_pengadaan.aktif", 1)
            ->where("role_pengadaan.tipe_surat", ($pengadaan->tipe_surat - 1))
            ->distinct('approval_doc_pengadaan.id_jabatan')->get();

        $lampiran = DocPengadaan::where("id_surat", $index)->count();

        $data = [
            'title' => 'Surat Permohonan',
            'date' => date('m/d/Y'),
            'logoPath' => str_replace("", "", getcwd()) . '/vendors/images/big_logo.png',
            'data' => $approval_doc,
            'jabatan' => $jabatan,
            'lampiran' => $lampiran,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPengadaan', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream(str_replace("/", "-", $pengadaan->no_surat) . '.pdf'); // Stream in the browser
        // return $pdf->download('sample.pdf'); // Download directly
    }

    public function createZipPengadaan(Request $request)
    {
        $zip = new ZipArchive;

        $index = $request->index;

        $pengadaan = Pengadaan::where("id", $request->index)->get();

        $fileName = 'pdf-reporting-pengadaan-archive.zip';

        if (file_exists(storage_path('app/public/' . $fileName))) {
            unlink(storage_path('app/public/' . $fileName));
        }

        $approval_doc = Pengadaan::where("id", $index)->first();
        $persetujuan = Persetujuan::where("id_permohonan", $index)->first();

        $jabatan = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $index)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 0)->where("role_pengadaan.id_unit_usaha", $pengadaan[0]->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan[0]->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();
        $menyetujui = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $index)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 1)->where("role_pengadaan.id_unit_usaha", $pengadaan[0]->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan[0]->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();

        $lampiran = DocPengadaan::where("id_surat", $index)->count();

        $data = [
            'title' => 'Surat Permohonan',
            'date' => date('m/d/Y'),
            'logoPath' => str_replace("", "", getcwd()) . '/vendors/images/big_logo.png',
            'data' => $approval_doc,
            'lampiran' => $lampiran,
            'jabatan' => $jabatan,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPengadaan', $data);

        $path = 'pdfs/' . str_replace("/", "-", $pengadaan[0]->no_surat);

        Storage::put($path, $pdf->output());

        $approval_doc = Pengadaan::where("id", $index)->first();

        $jabatan = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $index)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 0)->where("role_pengadaan.id_unit_usaha", $pengadaan[0]->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan[0]->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();
        $menyetujui = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $index)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 1)->where("role_pengadaan.id_unit_usaha", $pengadaan[0]->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan[0]->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();
        $lampiran = DocPengadaan::where("id_surat", $persetujuan->id)->count();

        $data = [
            'title' => 'Surat Permohonan',
            'date' => date('m/d/Y'),
            'lampiran' => $lampiran,
            'logoPath' => str_replace("", "", getcwd()) . '/vendors/images/big_logo.png',
            'data' => $approval_doc,
            'jabatan' => $jabatan,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPengadaan', $data);

        $path = 'pdfs/persetujuan-' . str_replace("/", "-", $pengadaan[0]->no_surat);

        Storage::put($path, $pdf->output());
        //Storage::put($path, $pdf->output());

        if ($zip->open(storage_path('app/public/' . $fileName), ZipArchive::CREATE) === TRUE) {
            $pengadaan = Pengadaan::where("id", $request->index)->get();

            $attach = DocPengadaan::where("id_surat", $request->index)->get();

            $zip->addFile(storage_path('app/pdfs/' . str_replace("/", "-", $pengadaan[0]->no_surat)), "surat-pengadaan-" . $pengadaan[0]->no_surat . "." . "pdf");

            $index = 0;
            foreach ($attach as $files) {
                $index++;
                $exx = explode(".", $files->nama_dokumen);
                $zip->addFile(storage_path('app/public/uploads/' . $files->nama_dokumen), "file-attachment-" . $index . "." . $exx[1]);
            }

            $persetujuan = Persetujuan::where("id_permohonan", $pengadaan[0]->id)->first();
            $docsPersetujuan = dokumenPersetujuan::where("id_surat", $persetujuan->id)->get();

            $zip->addFile(storage_path('app/pdfs/persetujuan-' . str_replace("/", "-", $pengadaan[0]->no_surat)), "surat-persetujuan-" . $persetujuan->no_surat . "." . "pdf");

            $index = 0;
            foreach ($docsPersetujuan as $files) {
                $index++;
                $exx = explode(".", $files->nama_dokumen);
                $zip->addFile(storage_path('app/public/uploads/persetujuan/' . $files->nama_dokumen), "file-attachment-persetujuan-" . $index  . "." . $exx[1]);
            }

            $zip->close();
        }

        //return Storage::disk('public')->download($fileName)->deleteFileAfterSend(true);
        //return response()->stream(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);
        return response()->download(
            storage_path('app/public/' . $fileName),
            $pengadaan[0]->no_surat . '.zip', // Nama file yang di-download oleh user
            ['Content-Type' => 'application/zip']
        )->deleteFileAfterSend(true);
    }

    public function createZipPembayaran(Request $request)
    {
        $zip = new ZipArchive;

        $pengadaan = Pembayaran::where("id", $request->index)->get();

        $fileName = 'pdf-reporting-pengadaan-archive' . $pengadaan[0]->no_surat . '.zip';


        if (file_exists(storage_path('app/public/' . $fileName))) {
            unlink(storage_path('app/public/' . $fileName));
        }

        if ($zip->open(storage_path('app/public/' . $fileName), ZipArchive::CREATE) === TRUE) {
            // Add files to the zip
            //$files = Storage::files('public/files-to-zip');

            $attach = DocPengadaan::where("id_surat", $request->index)->get();

            $index = 0;
            foreach ($attach as $files) {
                $index++;
                $exx = explode(".", $files->nama_dokumen);
                $zip->addFile(storage_path('app/public/uploads/' . $files->nama_dokumen), "file-attachment-" . $index . "." . $exx[1]);
            }

            $zip->close();
        }

        //return Storage::disk('public')->download($fileName)->deleteFileAfterSend(true);
        return response()->stream(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);
    }

    public function createZipPettycash(Request $request)
    {
        $zip = new ZipArchive;
        $pengadaan = pettyCash::where("id", $request->index)->get();

        $fileName = 'pdf-reporting-pettycash-archive' . $pengadaan[0]->no_surat . '.zip';

        if (file_exists(storage_path('app/public/' . $fileName))) {
            unlink(storage_path('app/public/' . $fileName));
        }

        if ($zip->open(storage_path('app/public/' . $fileName), ZipArchive::CREATE) === TRUE) {
            $attach = DocPettyCash::where("id_surat", $request->index)->get();

            $index = 0;
            foreach ($attach as $files) {
                $index++;
                $exx = explode(".", $files->nama_dokumen);
                $zip->addFile(storage_path('app/public/uploads/' . $files->nama_dokumen), "file-attachment-" . $index . "." . $exx[1]);
            }

            $zip->close();
        }

        //return Storage::disk('public')->download($fileName)->deleteFileAfterSend(true);
        return response()->stream(storage_path('app/public/' . $fileName))->deleteFileAfterSend(true);
    }

    public function showPembayaran(Request $request, $index)
    {
        $approval_doc = Pembayaran::where("id", $index)->first();

        $pengadaan = Pembayaran::where("id", $index)->first();

        if ($pengadaan && $pengadaan->id_unit_usaha !== null && (int)Auth::user()->id_positions !== -1) {
            if (app("App\Helpers\Setting")->checkValidate($pengadaan->id_unit_usaha) === false) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $cnPengadaan = Pembayaran::where("id", $index)->count();
        $approvalCount = approval_surat_pembayaran::where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->count();

        if ((int)Auth::user()->id_positions !== -1) {
            if ($cnPengadaan === 0 || $approvalCount === 0) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $jabatan = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")
            ->join("users", "users.id", "approval_doc_pembayarans.approved_by")
            ->join("role_pembayaran", "role_pembayaran.id_role", "approval_doc_pembayarans.id_jabatan")
            ->select("approval_doc_pembayarans.*", "positions.name", "users.*", "role_pembayaran.is_menyetujui")
            ->where("approval_doc_pembayarans.id_surat", $index)
            ->where("approval_doc_pembayarans.status", 1)
            ->where("role_pembayaran.menyetujui", 0)
            ->where("role_pembayaran.aktif", 1)
            ->distinct('approval_doc_pembayarans.id_jabatan')->get();

        $menyetujui = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")
            ->join("users", "users.id", "approval_doc_pembayarans.approved_by")
            ->join("role_pembayaran", "role_pembayaran.id_role", "approval_doc_pembayarans.id_jabatan")
            ->select("approval_doc_pembayarans.*", "positions.name", "users.*", "role_pembayaran.is_menyetujui")
            ->where("approval_doc_pembayarans.id_surat", $index)
            ->where("approval_doc_pembayarans.status", 1)
            ->where("role_pembayaran.menyetujui", 1)
            ->where("role_pembayaran.aktif", 1)
            ->distinct('approval_doc_pembayarans.id_jabatan')->get();

        $lampiran = DocPembayaran::where("id_surat", $request->index)->count();

        $data = [
            'title' => 'Surat Permohonan',
            'date' => date('m/d/Y'),
            'logoPath' => str_replace("", "", getcwd()) . '/vendors/images/big_logo.png',
            'data' => $approval_doc,
            'jabatan' => $jabatan,
            'lampiran' => $lampiran,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPembayaran', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream(str_replace("/", "-", $pengadaan->no_surat) . '.pdf'); // Stream in the browser
        // return $pdf->download('sample.pdf'); // Download directly
    }

    public function showPettyCash(Request $request, $index)
    {
        $approval_doc = pettyCash::where("id", $index)->first();

        //$user = User::where("id" , Auth::user()->id)->first();

        $pengadaan = pettyCash::where("id", $index)->first();

        if ($pengadaan && $pengadaan->id_unit_usaha !== null) {
            if (app("App\Helpers\Setting")->checkValidate($pengadaan->id_unit_usaha) === false) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $cnPengadaan = pettyCash::where("id", $index)->count();
        $approvalCount = approval_surat_pety_cash::where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->count();

        if ((int)Auth::user()->id_positions !== -1) {
            if ($cnPengadaan === 0 || $approvalCount === 0) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $lampiran = DocPettyCash::where("id_surat", $request->index)->count();

        // $user = User::where("id", $pengadaan->id_unit_usaha)->first();

        $jabatan = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")
            ->join("users", "users.id", "approval_doc_pettycash.approved_by")
            ->join("role_petty_cash", "role_petty_cash.id_role", "approval_doc_pettycash.id_jabatan")
            ->select("approval_doc_pettycash.*", "positions.name", "users.*")
            ->where("approval_doc_pettycash.id_surat", $index)
            ->where("approval_doc_pettycash.status", 1)
            ->where("role_petty_cash.menyetujui", 0)
            ->where("role_petty_cash.aktif", 1)->get();

        $menyetujui = approval_surat_pety_cash::join("positions", "positions.id", "approval_doc_pettycash.id_jabatan")->join("users", "users.id", "approval_doc_pettycash.approved_by")->join("role_petty_cash", "role_petty_cash.id_role", "approval_doc_pettycash.id_jabatan")->select("approval_doc_pettycash.*", "positions.name", "users.*")->where("approval_doc_pettycash.id_surat", $index)->where("approval_doc_pettycash.status", 1)->where("role_petty_cash.menyetujui", 1)->where("role_petty_cash.id_unit_usaha", $pengadaan->id_unit_usaha)->where("role_petty_cash.aktif", 1)->get();

        $data = [
            'title' => 'Dokumen Petty Cash',
            'date' => date('m/d/Y'),
            'logoPath' => str_replace("", "", getcwd()) . '/vendors/images/big_logo.png',
            'data' => $approval_doc,
            'lampiran' => $lampiran,
            'jabatan' => $jabatan,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPettyCash', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream(str_replace("/", "-", $pengadaan->no_surat) . '.pdf'); // Stream in the browser
        // return $pdf->download('sample.pdf'); // Download directly
    }

    public function showPersetujuanPDF(Request $request, $index)
    {
        $approval_doc = Persetujuan::where("id", $index)->first();

        $pengadaan = Pengadaan::where("id", $approval_doc->id_permohonan)->first();

        if ($pengadaan && $pengadaan->id_unit_usaha !== null) {
            if (app("App\Helpers\Setting")->checkValidate($pengadaan->id_unit_usaha) === false) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $cnPengadaan = Persetujuan::where("id", $index)->count();
        $approvalCount = approval_surat_pengadaan::where("id_surat", $index)->where("id_jabatan", Auth::user()->role_id)->count();

        if ((int)Auth::user()->id_positions !== -1) {
            if ($cnPengadaan === 0 || $approvalCount === 0) {
                return \Redirect::route('dashboard')->with('message', 'UnAuthenticated!!!');
            }
        }

        $lampiran = DocPengadaan::where("id_surat", $request->index)->count();

        $jabatan = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $approval_doc->id_permohonan)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 0)->where("role_pengadaan.id_unit_usaha", $pengadaan->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();
        $menyetujui = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $approval_doc->id_permohonan)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 1)->where("role_pengadaan.id_unit_usaha", $pengadaan->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();

        $data = [
            'title' => 'Surat Persetujuan',
            'date' => date('m/d/Y'),
            'logoPath' => str_replace("", "", getcwd()) . '/vendors/images/big_logo.png',
            'data' => $approval_doc,
            'jabatan' => $jabatan,
            'lampiran' => $lampiran,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPersetujuan', $data);

        return $pdf->stream(str_replace("/", "-", $pengadaan->no_surat) . '.pdf'); // Stream in the browser
    }

    public function saveSignature(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|string',
        ]);

        // Extract the base64 encoded image data
        $imageData = $request->input('image');
        $imageParts = explode(',', $imageData);

        if (count($imageParts) == 2) {
            // Decode the image
            $decodedData = base64_decode($imageParts[1]);

            // Generate a unique file name
            $fileName = 'signatures/' . uniqid('signature_', true) . '.png';

            // Save the file to the 'public' disk
            Storage::disk('public')->put($fileName, $decodedData);

            \Session::put("imageSaved", $fileName);

            return response()->json(['message' => 'Signature saved successfully New!', 'file' => $fileName], 200);
        }

        return response()->json(['message' => 'Invalid image data.'], 400);
    }

    public function exportPdfReport(Request $request, $tipe, $periode)
    {
        $periode = $periode;
        $tipeSurat = $tipe;

        $suratPengadaan = "";

        $dataExport = [];

        if (Auth::user()->id_positions == "-1" || Auth::user()->id_positions == "0" || Auth::user()->role_status === 1) {
            // $pengadaan = Pengadaan::where("isPermohonan", '!=', 1)->where("position", "!=", 0)->orderBy("id", "desc");
            // $pembayaran = Pembayaran::where("deleted_at", null)->where("position", "1")->orderBy("id", "desc")->paginate(10);
            // $surat = pettyCash::where("position", "1")->orderBy("id", "desc")->paginate(10);
            if ($tipe === 1) {
                $dataExport = Pengadaan::where("isPermohonan", '!=', 1)->where("position", "!=", 0);
            } else if ($tipe === 2) {
                $dataExport = Pembayaran::where("deleted_at", null)->where("position", "1");
            } else {
                $dataExport = pettyCash::where("position", "1");
            }
        } else {
            if ($tipe === 1) {
                $dataExport = Pengadaan::where("isPermohonan", '!=', 1)->where("id_unit_usaha", Auth::user()->id_positions)->where("position", "!=", 0);
            } else if ($tipe === 2) {
                $dataExport = Pembayaran::where("deleted_at", null)->where("id_unit_usaha", Auth::user()->id_positions)->where("position", "1");
            } else {
                $dataExport = pettyCash::where("position", "1")->where("id_unit_usaha", Auth::user()->id_positions);
            }
            // $pengadaan = Pengadaan::select("pengadaan.*")->where("isPermohonan", '!=', 1)->where("position", "!=", 0)->join("approval_doc_pengadaan", "approval_doc_pengadaan.id_surat", "pengadaan.id")->where("approval_doc_pengadaan.id_jabatan", Auth::user()->role_id)->where("approval_doc_pengadaan.is_next", 1)->where("pengadaan.id_unit_usaha", Auth::user()->id_positions)->orderBy("pengadaan.id", "desc");
            // $pembayaran = Persetujuan::where("id_unit_usaha", Auth::user()->id_positions)->where("position", "1")->orderBy("id", "desc")->paginate(10);
            // $surat = Pembayaran::orderBy("id", "desc")->where("position", "1")->join("approval_doc_pettycash", "approval_doc_pettycash.id_surat", "petty_cashes.id")->where("petty_cashes.id_unit_usaha", Auth::user()->id_positions)->paginate(10);
        }

        // echo $periode;
        // return;

        if ($periode == "1") {
            $sekarang = time();
            $satuBulanLalu = strtotime('-1 month', $sekarang);
            $periode = date('Y-m-d', $satuBulanLalu);

            $dataExport = $dataExport->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
        } else if ($periode == "2") {
            $sekarang = time();
            $satuBulanLalu = strtotime('-3 month', $sekarang);
            $periode = date('Y-m-d', $satuBulanLalu);

            $dataExport = $dataExport->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
        } else if ($periode == "3") {
            $sekarang = time();
            $satuBulanLalu = strtotime('-6 month', $sekarang);
            $periode = date('Y-m-d', $satuBulanLalu);

            $dataExport = $dataExport->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
        } else if ($periode == "4") {
            $sekarang = time();
            $satuBulanLalu = strtotime('-12 month', $sekarang);
            $periode = date('Y-m-d', $satuBulanLalu);

            $dataExport = $dataExport->where("created_at", ">=", $periode)->where("created_at", "<=", date("Y-m-d"));
        }

        $dataExport = $dataExport->orderBy("id")->get();

        $data = [
            'title' => 'Dokumen Pengadan',
            "data" => $periode,
            "tipe" => $tipeSurat,
            "dataExport" => $dataExport,
            'logoPath' => str_replace("", "", getcwd()) . '/vendors/images/big_logo.png'
        ];

        $pdf = PDF::loadView('pdf.exportedSuratList', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream(str_replace("/", "-", "export-laporan-" . $suratPengadaan . '.pdf'));
    }

    public function saveSignatureNew(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|string',
        ]);

        // Extract the base64 encoded image data
        $imageData = $request->input('image');
        $imageParts = explode(',', $imageData);

        if (count($imageParts) == 2) {
            // Decode the image
            $decodedData = base64_decode($imageParts[1]);

            // Generate a unique file name
            $fileName = 'signatures/' . uniqid('signature_', true) . '.png';

            // Save the file to the 'public' disk
            Storage::disk('public')->put($fileName, $decodedData);

            \Session::put("imageSaved", $fileName);

            User::where("id", $request->input('sig_t_index'))->update(array(
                'signature_url' => $fileName
            ));

            return response()->json(['message' => 'Signature saved successfully ! ', 'redirectUrl' => route('detailUsaha', [$request->sig_unit_usaha_edit . "?tab=users"]), 'file' => $fileName], 200);
        }

        return response()->json(['message' => 'Invalid image data.'], 400);
    }
}
