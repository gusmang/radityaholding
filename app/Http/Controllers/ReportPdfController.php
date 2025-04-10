<?php

namespace App\Http\Controllers;

use App\Models\approval_surat_pembayaran;
use App\Models\approval_surat_pengadaan;
use App\Models\approval_surat_pety_cash;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Pengadaan;
use App\Models\Persetujuan;
use App\Models\pettyCash;
use App\Models\rolePembayaran;
use App\Models\rolePengadaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ReportPdfController extends Controller
{

    public function signature_new(Request $request)
    {
        return view("dashboard.pages.dashboard.canvas");
    }

    public function generatePDF(Request $request)
    {
        $fileName = 'signatures/' . uniqid('signature_', true) . '.png';

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

        //$user = User::where("id" , Auth::user()->id)->first();

        $pengadaan = Pengadaan::where("id", $index)->first();

        $user = User::where("id", $pengadaan->id_unit_usaha)->first();

        $jabatan = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $index)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 0)->where("role_pengadaan.id_unit_usaha", $pengadaan->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();
        $menyetujui = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $index)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 1)->where("role_pengadaan.id_unit_usaha", $pengadaan->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();

        $row = rolePengadaan::where("menyetujui", 0)->where("id_unit_usaha", $pengadaan->id_unit_usaha)->where("aktif", 1)->where("tipe_surat", 0)->get();


        $data = [
            'title' => 'Surat Permohonan',
            'date' => date('m/d/Y'),
            'logoPath' => str_replace("", "", getcwd()) . '/public/vendors/images/logo.png',
            'data' => $approval_doc,
            'jabatan' => $jabatan,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPengadaan', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream('sample.pdf'); // Stream in the browser
        // return $pdf->download('sample.pdf'); // Download directly
    }

    public function showPembayaran(Request $request, $index)
    {
        $approval_doc = Pembayaran::where("id", $index)->first();

        $pengadaan = Pembayaran::where("id", $index)->first();

        $jabatan = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")
            ->join("users", "users.id", "approval_doc_pembayarans.approved_by")
            ->join("role_pembayaran", "role_pembayaran.id_role", "approval_doc_pembayarans.id_jabatan")
            ->select("approval_doc_pembayarans.*", "positions.name", "users.*")
            ->where("approval_doc_pembayarans.id_surat", $index)
            ->where("approval_doc_pembayarans.status", 1)
            ->where("role_pembayaran.menyetujui", 0)
            ->where("role_pembayaran.aktif", 1)
            ->distinct('approval_doc_pembayarans.id_jabatan')->get();

        $menyetujui = approval_surat_pembayaran::join("positions", "positions.id", "approval_doc_pembayarans.id_jabatan")
            ->join("users", "users.id", "approval_doc_pembayarans.approved_by")
            ->join("role_pembayaran", "role_pembayaran.id_role", "approval_doc_pembayarans.id_jabatan")
            ->select("approval_doc_pembayarans.*", "positions.name", "users.*")
            ->where("approval_doc_pembayarans.id_surat", $index)
            ->where("approval_doc_pembayarans.status", 1)
            ->where("role_pembayaran.menyetujui", 1)
            ->where("role_pembayaran.aktif", 1)
            ->distinct('approval_doc_pembayarans.id_jabatan')->get();

        $data = [
            'title' => 'Surat Permohonan',
            'date' => date('m/d/Y'),
            'logoPath' => str_replace("", "", getcwd()) . '/public/vendors/images/logo.png',
            'data' => $approval_doc,
            'jabatan' => $jabatan,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPembayaran', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream('sample.pdf'); // Stream in the browser
        // return $pdf->download('sample.pdf'); // Download directly
    }

    public function showPettyCash(Request $request, $index)
    {
        $approval_doc = pettyCash::where("id", $index)->first();

        //$user = User::where("id" , Auth::user()->id)->first();

        $pengadaan = pettyCash::where("id", $index)->first();

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
            'logoPath' => str_replace("", "", getcwd()) . '/public/vendors/images/logo.png',
            'data' => $approval_doc,
            'jabatan' => $jabatan,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPettyCash', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream('pettyCashes.pdf'); // Stream in the browser
        // return $pdf->download('sample.pdf'); // Download directly
    }

    public function showPersetujuanPDF(Request $request, $index)
    {
        $approval_doc = Persetujuan::where("id", $index)->first();

        //$user = User::where("id" , Auth::user()->id)->first();

        //$user = User::where("id" , Auth::user()->id)->first();

        $pengadaan = Pengadaan::where("id", $approval_doc->id_permohonan)->first();

        $user = User::where("id", $pengadaan->id_unit_usaha)->first();

        // $jabatan = DB::table('users')
        //     ->where(function ($query) use ($user) {
        //         $query->where('id_positions',  0)
        //             ->orWhere('id_positions',  $user->id_positions);
        //     })
        //     ->where(function ($query) use ($index) {
        //         $query->where('role_status',  1)
        //             ->orWhere('id_positions', 0);
        //     })
        //     ->where('status', 1)
        //     ->orderBy('role_pengadaan', 'asc')
        //     ->get();

        $jabatan = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $approval_doc->id_permohonan)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 0)->where("role_pengadaan.id_unit_usaha", $pengadaan->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();
        $menyetujui = approval_surat_pengadaan::join("positions", "positions.id", "approval_doc_pengadaan.id_jabatan")->join("users", "users.id", "approval_doc_pengadaan.approved_by")->join("role_pengadaan", "role_pengadaan.id_role", "approval_doc_pengadaan.id_jabatan")->select("approval_doc_pengadaan.*", "positions.name", "users.*")->where("approval_doc_pengadaan.id_surat", $approval_doc->id_permohonan)->where("approval_doc_pengadaan.status", 1)->where("role_pengadaan.menyetujui", 1)->where("role_pengadaan.id_unit_usaha", $pengadaan->id_unit_usaha)->where("role_pengadaan.aktif", 1)->where("role_pengadaan.tipe_surat", ($pengadaan->tipe_surat - 1))->distinct('approval_doc_pengadaan.id_jabatan')->get();

        $row = rolePengadaan::where("menyetujui", 0)->where("id_unit_usaha", $pengadaan->id_unit_usaha)->where("aktif", 1)->where("tipe_surat", 0)->get();

        //foreach($)

        //print_r($jabatan);
        // echo '<pre>' . print_r($jabatan, true) . '</pre>';
        // die();

        $data = [
            'title' => 'Surat Persetujuan',
            'date' => date('m/d/Y'),
            'logoPath' => str_replace("", "", getcwd()) . '/public/vendors/images/logo.png',
            'data' => $approval_doc,
            'jabatan' => $jabatan,
            'menyetujui' => $menyetujui
        ];

        $pdf = PDF::loadView('pdf.suratPersetujuan', $data);

        // Optionally, stream or download the PDF
        return $pdf->stream('sample.pdf'); // Stream in the browser
    }

    // public function showPersetujuanPDF(Request $request, $index)
    // {
    //     $persetujuan = Persetujuan::where("id", $index)->first();
    //     $approval_doc = Pengadaan::where("id", $persetujuan->id_permohonan)->first();
    //     //$user = User::where("id" , Auth::user()->id)->first();
    //     $approval_docs = Pengadaan::where("id", $persetujuan->id_permohonan)->first();

    //     $pengadaan = Pengadaan::where("id", $persetujuan->id_permohonan)->first();

    //     $user = User::where("id", $pengadaan->id_unit_usaha)->first();

    //     $jabatan = DB::table('users')
    //         ->where(function ($query) use ($user) {
    //             $query->where('id_positions',  0)
    //                 ->orWhere('id_positions',  $user->id_positions);
    //         })
    //         ->where(function ($query) use ($user) {
    //             $query->where('role_status',  1)
    //                 ->orWhere('id_positions', 0);
    //         })
    //         ->where('status', 1)
    //         ->orderBy('role_pengadaan', 'asc')
    //         ->get();

    //     $data = [
    //         'title' => 'Laravel Dompdf Example',
    //         'date' => date('m/d/Y'),
    //         'logoPath' => public_path('storage/vendors/images/logo.png'),
    //         'data' => $persetujuan,
    //         'approval' => $approval_docs,
    //         'jabatan' => $jabatan
    //     ];

    //     $pdf = PDF::loadView('pdf.suratPersetujuan', $data);

    //     // Optionally, stream or download the PDF
    //     return $pdf->stream('sample.pdf'); // Stream in the browser
    //     // return $pdf->download('sample.pdf'); // Download directly
    // }

    //
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
