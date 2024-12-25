<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\AccessMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function crud(Request $request){
        $menu = Menu::where("is_active" , 1)->get();
        
        AccessMenu::where("id_jabatan" , $request->acc_t_index)->delete();

        foreach($menu as $rows){
            if($request->input("chk_menus_".$rows->id))
            {
                $accMenu = new AccessMenu();
                $accMenu->id_jabatan = $request->acc_t_index;
                $accMenu->id_menu = $request->input("chk_menus_".$rows->id);

                $accMenu->save();
            }
        }

        return response()->json(['message' => 'Update Access Menu Success' , 'redirectUrl' => route('settings', [$request->acc_unit_usaha_edit."index=1&tab=users"]), 'status' => 200], 200);
    }

    public function get(Request $request){
        $accMenu = AccessMenu::where("id_jabatan" , $request->index)->get();

        return response()->json(['message' => 'Update Access Menu Success' , 'data' => $accMenu, 'status' => 200], 200);
    }
}
