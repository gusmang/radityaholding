<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Unit {

    public function migrateDefault($user_id)
    {
        $data = [
            [
                "name" => "liter",
                "owner_id" => $user_id,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                "type" => 1,
                "symbol" => 0,
                "qty" => 1,
                "default" => 1,
                "deleted_at" => null,
                "remark" => "satuan ini adalah satuan referensi per type satuan",
                "convert_qty" => null
            ],
            [
                "name" => "m",
                "owner_id" => $user_id,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                "type" => 2,
                "symbol" => 0,
                "qty" => 1,
                "default" => 1,
                "deleted_at" => null,
                "remark" => "satuan ini adalah satuan referensi per type satuan",
                "convert_qty" => null
            ],
            [
                "name" => "kg",
                "owner_id" => $user_id,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                "type" => 3,
                "symbol" => 0,
                "qty" => 1,
                "default" => 1,
                "deleted_at" => null,
                "remark" => "satuan ini adalah satuan referensi per type satuan",
                "convert_qty" => null
            ],
            [
                "name" => "pcs",
                "owner_id" => $user_id,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
                "type" => 4,
                "symbol" => 0,
                "qty" => 1,
                "default" => 1,
                "deleted_at" => null,
                "remark" => "satuan ini adalah satuan referensi per type satuan",
                "convert_qty" => null
            ]
        ];

        DB::table('units')->insert($data);
    }
}