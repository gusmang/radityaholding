<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengadaan;
use App\Models\Persetujuan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ReportPdfController extends Controller
{

    public function signature_new(Request $request){
        return view("dashboard.pages.dashboard.canvas");
    }

    public function generatePDF(Request $request)
    {
            $fileName = 'signatures/' . uniqid('signature_', true) . '.png';

            $data = [
                'title' => 'Laravel Dompdf Example',
                'date' => date('m/d/Y'),
                'signaturePath' => public_path('storage/'.\Session::get("imageSaved")),
            ];
    
            $pdf = PDF::loadView('pdf.sample', $data);
    
            // Optionally, stream or download the PDF
            return $pdf->stream('sample.pdf'); // Stream in the browser
            // return $pdf->download('sample.pdf'); // Download directly
    }

    public function showPDF(Request $request , $index)
    {       
            $approval_doc = Pengadaan::where("id" , $index)->first();

            //$user = User::where("id" , Auth::user()->id)->first();

            $pengadaan = Pengadaan::where("id" , $index)->first();

            $user = User::where("id" , $pengadaan->id_unit_usaha)->first();

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

            $data = [
                'title' => 'Laravel Dompdf Example',
                'date' => date('m/d/Y'),
                'logoPath' => public_path('storage/vendors/images/logo.png'),
                'data' => $approval_doc,
                'jabatan' => $jabatan
            ];
    
            $pdf = PDF::loadView('pdf.suratPengadaan', $data);
    
            // Optionally, stream or download the PDF
            return $pdf->stream('sample.pdf'); // Stream in the browser
            // return $pdf->download('sample.pdf'); // Download directly
    }

    public function showPersetujuanPDF(Request $request , $index)
    {       
            $persetujuan = Persetujuan::where("id", $index)->first();
            $approval_doc = Pengadaan::where("id" , $persetujuan->id_permohonan)->first();
            //$user = User::where("id" , Auth::user()->id)->first();
            $approval_docs = Pengadaan::where("id" , $persetujuan->id_permohonan)->first();

            $pengadaan = Pengadaan::where("id" , $persetujuan->id_permohonan)->first();

            $user = User::where("id" , $pengadaan->id_unit_usaha)->first();

            $jabatan = DB::table('users')
            ->where(function ($query) use ($user) {
                $query->where('id_positions',  0)
                    ->orWhere('id_positions',  $user->id_positions);
            })
            ->where(function ($query) use ($user) {
                $query->where('role_status',  1)
                    ->orWhere('id_positions', 0);
            })
            ->where('status', 1)
            ->orderBy('role_pengadaan', 'asc')
            ->get();

            $data = [
                'title' => 'Laravel Dompdf Example',
                'date' => date('m/d/Y'),
                'logoPath' => public_path('storage/vendors/images/logo.png'),
                'data' => $persetujuan,
                'approval' => $approval_docs,
                'jabatan' => $jabatan
            ];
    
            $pdf = PDF::loadView('pdf.suratPersetujuan', $data);
    
            // Optionally, stream or download the PDF
            return $pdf->stream('sample.pdf'); // Stream in the browser
            // return $pdf->download('sample.pdf'); // Download directly
    }
    
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

            \Session::put("imageSaved" , $fileName);

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

            \Session::put("imageSaved" , $fileName);

            User::where("id" , $request->input('sig_t_index'))->update(array(
                'signature_url' => $fileName
            ));

            return response()->json(['message' => 'Signature saved successfully ! ', 'redirectUrl' => route('detailUsaha', [$request->sig_unit_usaha_edit."?tab=users"]), 'file' => $fileName], 200);
        }

        return response()->json(['message' => 'Invalid image data.'], 400);
    }
}
