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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_persetujuan');
            $table->string('no_surat');
            $table->string('title');
            $table->integer('id_unit_usaha');
            $table->string('unit_usaha');
            $table->string('diajukan');
            $table->string('tipe_surat');
            $table->string('perihal');
            $table->bigInteger('nominal_pengajuan');
            $table->text('detail');
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
        Schema::dropIfExists('pembayaran');
    }
};
