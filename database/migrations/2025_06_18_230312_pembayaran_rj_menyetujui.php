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
        Schema::table('role_pembayaran', function (Blueprint $table) {
            $table->boolean('rj')->default(0);
            $table->boolean('is_menyetujui')->default(0);
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
        Schema::dropIfExists('rj');
        Schema::dropIfExists('is_menyetujui');
    }
};
