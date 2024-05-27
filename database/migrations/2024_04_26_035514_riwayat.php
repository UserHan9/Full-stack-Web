<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('riwayat')) {
            Schema::create('riwayat', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('nama_kelas_id');
                $table->foreign('nama_kelas_id')->references('id')->on('lomba');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};