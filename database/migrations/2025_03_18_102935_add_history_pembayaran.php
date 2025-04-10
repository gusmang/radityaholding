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
        Schema::create('history_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_surat_pembayaran');
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
        Schema::dropIfExists('history_pembayaran');
    }
};
