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
        Schema::create('approval_doc_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('id_surat')->default(0);
            $table->integer('id_jabatan')->default(0);
            $table->integer('status')->default(0);
            $table->integer('note')->text();
            $table->integer('title')->string(255);
            $table->integer('is_next')->default(0);
            $table->integer('is_before')->default(0);
            $table->integer('approved_by')->default(0);
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
        Schema::dropIfExists('approval_doc_pembayaran');
    }
};