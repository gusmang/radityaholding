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
            $table->text('note');
            $table->string('title');
            $table->integer('next_id');
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
        Schema::dropIfExists('note');
        Schema::dropIfExists('title');
        Schema::dropIfExists('next_id');
    }
};
