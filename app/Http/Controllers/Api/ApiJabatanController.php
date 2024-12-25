<?php

namespace App\Http\Controllers\Api;

use Session;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Position;
use App\Models\roleHolding;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiJabatanController extends Controller
{
    public function index(Request $request){
        $position = Position::orderBy("name" , "asc")->get();

        $datas = [];

        foreach($position as $rows){
            array_push($datas, (object)[
                    'id' => $rows->id,
                    'text' => ucwords($rows->name)
            ]);
        }

        return response()->json($datas);
    }
}

?>