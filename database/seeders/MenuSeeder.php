<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_name = ["Overview" , "Laporan", "Daftar Surat", "Pengadaan","Pembayaran","Petty Cash","Template Surat","Unit Usaha","Pengaturan"];
        $menu_url = ["dashboard" , "laporan", "surat", "pengadaan","pembayaran","petty_cash","template_surat","unitUsaha","pengaturan"];

        for($an = 0; $an < count($menu_name); $an++){
            DB::table('menus')->insert([
    			'nama' => $menu_name[$an],
                'url' => $menu_url[$an],
                'parent_id' => 0,
                'section' => 1,
                'is_active' => 1
    		]);
        }
    }
}
