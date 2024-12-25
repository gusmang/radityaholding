<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class seedPosition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = ["Admin","Accounting","Inventory Staff","Cashier","IT Development","Manager","PIC Inventory","Head Manager","Super Admin","Owner/CEO"];
        $note  = ["Input Data","Staff Akuntan","Penanggung Jawab Barang Keluar/Masuk","Input Data Keluar/Masuk","IT Jaringan & Software","Manager","PIC Inventory","Head Manager","Penanggung Jawab Penuh Data","Pemilih Usaha"];
 
    	for($i = 0; $i < count($faker); $i++){
 
    		DB::table('positions')->insert([
                'uuid' => (string) Str::uuid(),
    			'name' => strtolower($faker[$i]),
                'note' => $note[$i],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
    		]);
 
    	}
    }
}
