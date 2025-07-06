<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Position;
use App\Models\UnitUsaha;
use App\Models\AccessMenu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    //
    // public function index(Request $request)
    // {
    //     $position = Position::orderBy("id","desc")->paginate(10);

    //     return view('dashboard.pages.pengaturan.index' , compact('position'));
    // }
    public function index(Request $request)
    {
        $position = Position::orderBy("id", "desc");
        $menu = Menu::where("is_active", 1)->get();

        if (isset($_GET['role_name'])) {
            $position = $position->where("name", "like", "%" . $_GET['role_name'] . "%");
        }

        $position = $position->paginate(10);

        return view('dashboard.pages.pengaturan.component.detail', compact('position', 'menu'));
    }

    public function editPositions(Request $request)
    {
        $edit = Position::where("id", $request->t_index_edit)->update(
            array(
                "name" => $request->edit_name,
                "is_unit_usaha" => $request->is_unit_usaha,
                "note" => $request->edit_note,
                'aktif' => $request->chk_aktif_edit === null ? "0" : $request->chk_aktif_edit
            )
        );

        if ($edit) {
            return response()->json(['message' => 'Edit Positions Success', 'redirectUrl' => route('settings'), 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Failed', 'status' => 400], 400);
        }
    }

    public function editMenu(Request $request)
    {
        $edit = Position::where("id", $request->t_index_edit)->update(
            array(
                "name" => $request->edit_name,
                "note" => $request->edit_note,
                'aktif' => $request->chk_aktif_edit === null ? "0" : $request->chk_aktif_edit
            )
        );

        if ($edit) {
            return response()->json(['message' => 'Edit Positions Success', 'redirectUrl' => route('settings'), 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Failed', 'status' => 400], 400);
        }
    }

    public function addPositions(Request $request)
    {
        $insertGetId = DB::table('positions')->insert([
            'name' => $request->name,
            'uuid' => Str::uuid(),
            'note' => $request->note == "" ? "-" : $request->note,
            'id_unit_usaha' => 0,
            'is_unit_usaha' => $request->is_unit_usaha,
            'aktif' => $request->chk_aktif_add === null ? "0" : "1"
        ]);

        $lastId = DB::getPdo()->lastInsertId();

        if ($insertGetId) {
            $menu = Menu::where("is_active", 1)->get();

            AccessMenu::where("id_jabatan", $insertGetId)->delete();

            foreach ($menu as $rows) {
                if ($request->input("chk_menu_" . $rows->id)) {
                    $accMenu = new AccessMenu();
                    $accMenu->id_jabatan = $lastId;
                    $accMenu->id_menu = $request->input("chk_menu_" . $rows->id);

                    $accMenu->save();
                }
            }

            return response()->json(['message' => 'Jabatan Berhasil ditambahkan', 'redirectUrl' => route('settings'), 'status' => 200], 200);
        } else {
            return response()->json(['message' => 'Failed', 'status' => 400], 400);
        }
    }
}
