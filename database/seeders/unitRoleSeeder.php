<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class unitRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        for($an = 0; $an <= 20; $an++){
            DB::table('unit_usaha')->insert([
    			'name' => $faker->name,
                'limit_petty_cash' => rand(20000000,200000000),
                'jumlah_unit' => rand(0,20),
                'status' => rand(0,1)
    		]);
        }
    }
}
