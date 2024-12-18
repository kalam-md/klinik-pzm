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
        Schema::create('pendaftaran_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran');
            $table->string('slug')->unique();
            $table->date('tanggal_pendaftaran');
            $table->enum('status', ['pending', 'selesai', 'gagal'])->default('pending');
            $table->string('keterangan')->nullable();
            $table->integer('nomor_antrian');
            $table->unsignedBigInteger('jadwaldokter_id');
            $table->foreign('jadwaldokter_id')->references('id')->on('jadwal_dokters')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_pasiens');
    }
};
