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
        Schema::table('pengadaan', function (Blueprint $table) {
            $table->boolean('isPermohonan')->default(0);
            $table->boolean('approvedPermohonan')->default(0);
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
        Schema::dropIfExists('isPermohonan');
        Schema::dropIfExists('approvedPermohonan');
    }
};
