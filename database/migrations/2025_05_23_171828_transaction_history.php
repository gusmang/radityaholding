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
        Schema::create('history_transaction', function (Blueprint $table) {
            $table->id();
            $table->integer('id_surat');
            $table->bigInteger('nominal');
            $table->text('keterangan');
            $table->boolean('is_pengeluaran')->default(0);
            $table->string('tipe_surat')->default("");
            $table->string('kategori_surat')->default("");
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
    }
};
