<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('role_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_unit_usaha');
            $table->integer('id_role');
            $table->integer('urutan');
            $table->boolean('aktif');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('role_petty_cash');
    }
};
