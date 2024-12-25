<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $faker = ["Admin","Accounting","Inventory Staff","Cashier","IT Development","Manager","PIC Inventory","Head Manager","Super Admin","Owner/CEO"];
        // $note  = ["Input Data","Staff Akuntan","Penanggung Jawab Barang Keluar/Masuk","Input Data Keluar/Masuk","IT Jaringan & Software","Manager","PIC Inventory","Head Manager","Penanggung Jawab Penuh Data","Pemilih Usaha"];
        $faker = Faker::create();

        $positions = DB::table('positions')->get();

    	foreach($positions as $rows){
 
    		DB::table('users')->insert([
                'name' => $faker->name,
    			'email' => $faker->email,
                'password' => Hash::make("123456"),
                'id_positions' => $rows->id,
                'role' => $rows->name,
                'reset_password_token' => '-',
                'signature_url' => '-',
                'is_verified' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
    		]);
 
    	}
    }
}
