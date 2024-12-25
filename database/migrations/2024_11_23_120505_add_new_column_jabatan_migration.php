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
        Schema::table('positions', function (Blueprint $table) {
            $table->integer('id_unit_usaha')->default(0);
            $table->boolean('is_unit_usaha')->default(0);
            $table->boolean('aktif')->default(0);
            $table->boolean('signature')->default(0);
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
        Schema::table('positions', function (Blueprint $table) {
            $table->dropColumn('id_unit_usaha');
            $table->dropColumn('is_unit_usaha');
            $table->dropColumn('aktif');
            $table->dropColumn('signature');
          });
    }
};
