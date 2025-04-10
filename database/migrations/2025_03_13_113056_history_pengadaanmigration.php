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
        // Schema::table('role_pengadaan', function (Blueprint $table) {
        //     $table->boolean('is_menyetujui')->default(0);
        // });
        Schema::create('history_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_surat_pengadaan');
            $table->integer('id_user');
            $table->string('title');
            $table->text('note');
            $table->datetime('tanggal');
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
        //Schema::dropIfExists('is_menyetujui');
        Schema::dropIfExists('history_pengadaan');
    }
};
