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
        Schema::table('approval_doc_pembayarans', function (Blueprint $table) {
            $table->integer('is_next')->default(0);
            $table->integer('is_before')->default(0);
            $table->integer('approved_by')->default(0);
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
        Schema::dropIfExists('is_next');
        Schema::dropIfExists('is_before');
        Schema::dropIfExists('approved_by');
    }
};
