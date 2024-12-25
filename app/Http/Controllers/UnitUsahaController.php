<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Position;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitUsahaController extends Controller
{
    //
    public function index(Request $request)
    {
        $unitUsaha = UnitUsaha::orderBy("id","desc")->paginate(10);

        return view('dashboard.pages.unitUsaha.index' , compact('unitUsaha'));
    }

    public function detailUsaha(Request $request , $index)
    {
        $unitUsaha = UnitUsaha::where("id" , $index)->first();
        $users = User::where("id_positions" , $index)->orderBy("id","desc")->paginate(10);
        
        $users_pembayaran = User::where("id_positions" , "!=" , "0")->where("id_positions" , $index)->where("status" , 1)->orderBy("role_pembayaran","asc")->get();
        $jabatan = Position::where("deleted_at" , null)->get();
        $menu = Menu::where("is_active" , 1)->get();

        // $users_pengadaan = User::where("id_positions" , "!=" , "0")->where("id_positions" , $index)->where("status" , 1)->orderBy("role_pengadaan","asc")->get();
        // $users_holding = User::where("id_positions" , "!=" , "0")->where("status" , 1)->get();

        $users_pengadaan = DB::table('users')
        ->where(function ($query) use ($index) {
            $query->where('id_positions',  0)
                  ->orWhere('id_positions', $index);
        })
        ->where(function ($query) use ($index) {
            $query->where('role_status',  1)
                  ->orWhere('id_positions', 0);
        })
        ->where('status', 1)
        ->orderBy('role_pengadaan', 'asc')
        ->get();

        $users_pembayaran = DB::table('users')
        ->where(function ($query) use ($index) {
            $query->where('id_positions', $index);
        })
        ->where(function ($query) use ($index) {
            $query->where('role_status',  2);
        })
        ->where('status', 1)
        ->orderBy('role_pembayaran', 'asc')
        ->get();

        $users_petty_cash = DB::table('users')
        ->where(function ($query) use ($index) {
            $query->where('id_positions', $index);
        })
        ->where(function ($query) use ($index) {
            $query->where('role_status',  3);
        })
        ->where('status', 1)
        ->orderBy('role_pembayaran', 'asc')
        ->get();

        $users_holding = User::where("id_positions" , "!=" , "0")->where("status" , 1)->get();

        return view('dashboard.pages.unitUsaha.component.detail' , compact('unitUsaha','users','jabatan','users_pengadaan','users_pembayaran','menu','users_petty_cash'));
    }

    public function editPosPembayaran(Request $request){
        $indexUsaha = $request->t_index_pembayaran;
        $roleCount = $request->t_jumlah_role_pembayaran;

        for($an = 1; $an <= $roleCount; $an++){
            $idRole = $request->input("id_role_pembayaran_".$an);
            $posRole = $request->input("role_pembayaran_".$an);

            User::where("id" , $idRole)->update(array(
                "role_pembayaran" => $posRole
            ));
        }

        return response()->json(['message' => 'Update Role Success' , 'redirectUrl' => route('detailUsaha', [$indexUsaha."?tab=pembayaran"]), 'status' => 200], 200);
    }

    public function usahaPost(Request $request){
        $insert = DB::table('unit_usaha')->insert([
            'name' => $request->unitUsaha,
            'id_unit_bisnis' => $request->id_unit_bisnis,
            'limit_petty_cash' => $request->limit_petty_cash,
            'jumlah_unit' => 0,
            'status' => $request->chk_aktif === null ? "0" : $request->chk_aktif 
        ]);

        if($insert){
            return response()->json(['message' => 'Add Unit Usaha Success' , 'status' => 200], 200);
        }
        else{
            return response()->json(['message' => 'Gagal Update Usaha Success' , 'status' => 400], 400);
        }
    }

    public function editPosPengadaan(Request $request){
        $indexUsaha = $request->t_index_pengadaan;
        $roleCount = $request->t_jumlah_role;

        for($an = 1; $an <= $roleCount; $an++){
            $idRole = $request->input("id_role_pengadaan_".$an);
            $posRole = $request->input("role_pengadaan_".$an);

            User::where("id" , $idRole)->update(array(
                "role_pengadaan" => $posRole
            ));
        }

        return response()->json(['message' => 'Update Role Success' , 'redirectUrl' => route('detailUsaha', [$indexUsaha."?tab=pengadaan"]), 'status' => 200], 200);
    }

    public function usahaEdit(Request $request){
        $update = UnitUsaha::where("id" , $request->t_index)->update(array(
            "name" => $request->unitUsaha,
            "id_unit_bisnis" => $request->id_unit_bisnis,
            "limit_petty_cash" => $request->limit_petty_cash,
            'status' => $request->chk_aktif === null ? "0" : $request->chk_aktif 
        ));

        if($update){
            return response()->json(['message' => 'Update Unit Usaha Success' , 'status' => 200], 200);
        }
        else{
            return response()->json(['message' => 'Gagal Update Usaha Success' , 'status' => 400], 400);
        }
    }
}
