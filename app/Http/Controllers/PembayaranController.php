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
use App\Models\ApprovalDocPembayaran;
use Illuminate\Support\Facades\Session;
use Kutia\Larafirebase\Facades\Larafirebase;

class PembayaranController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy("id","desc")->paginate(10);
        $jabatan = Position::where("deleted_at" , null)->get();
        $pengadaan = Pengadaan::where("isPermohonan", 1)->orderBy("id" , "desc")->paginate(10);

        return view('dashboard.pages.pembayaran.index' , compact('users' , 'jabatan' , 'pengadaan'));
    }

    public function detailPembayaran(Request $request , $index){
        $unitUsaha = UnitUsaha::orderBy("name","asc")->get();
         
        $approvalDoc = approvalDocument::where("id_surat" , $index)->orderBy("id","asc")->get();
        $pengadaan = Pengadaan::where("id" , $index)->first();

        $user = User::where("id" , $pengadaan->id_unit_usaha)->first();
        $setuju = Persetujuan::where("id_permohonan" , $index)->get();

        $jabatan = DB::table('users')
        ->where(function ($query) use ($user) {
            $query->where('id_positions',  $user->id_positions);
        })
        ->where(function ($query) use ($index) {
            $query->where('role_status',  2);
        })
        ->where('status', 1)
        ->orderBy('role_pengadaan', 'asc')
        ->get();

        $dokumen = Dokumen::where("id_surat" , $index)->get();
        
        $lastApprove = "";
        $inc = 0;
        foreach($jabatan as $rows){
            if(($pengadaan->approvedPermohonan) == $inc){
                if($rows->id_positions == "0"){
                    $lastApprove = $rows->id;
                }
                else{
                    $lastApprove = $rows->role_id;
                }
                break;
            }
            $inc++;
        }

        return view('dashboard.pages.pembayaran.detail.sub.index' , compact('jabatan','lastApprove','unitUsaha','dokumen','pengadaan','approvalDoc','setuju'));
    }

    public function approvalDocument(Request $request){
        $id = $request->teks_dokumen_pengadaan;
        $note = $request->verifikasi_berkas;
        
        $lastPos = Pengadaan::where("id" , $id)->first();
        
        $update = Pengadaan::where("id" , $id)->update(array(
            "position" => ($lastPos->position)+1
        ));

        $user = User::where("id" , $request->t_login)->first();

        if($update){
            $approval = new ApprovalDocPembayaran();
            $approval->nama = "Surat disetujui oleh ".$request->teks_branch_approval." ( ".$request->teks_person_approval." ) ";
            $approval->note = $note;
            $approval->title = $request->teks_person_approval;
            $approval->id_jabatan = $user->role_id;
            $approval->id_surat = $id;
            $approval->next_id = $lastPos->position+1;
            $approval->status = 1;

            if($approval->save()){
                return response()->json(['message' => 'Update Approval Success' , 'redirectUrl' => route('detailPengadaan',['index'=> $id]), 'status' => 200], 200);
            }
        }
    }
}
