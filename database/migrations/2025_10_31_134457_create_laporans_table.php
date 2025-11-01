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
    Schema::create('laporan', function (Blueprint $table) {
        $table->id();
        // Ini penting: Kita butuh tahu siapa user yang melapor
        $table->foreignId('pelapor_id')->constrained('users');
        $table->string('nama_pelapor'); // Sesuai ERD, bisa juga di-default dari user
        $table->string('status')->default('pending'); // mis: pending, disetujui, dikerjakan, selesai
        $table->string('lokasi');
        $table->text('keterangan');
        // Sesuai ERD, ini adalah FK ke tabel users
        $table->foreignId('petugas_id')->nullable()->constrained('users');
        $table->foreignId('dinas_id')->nullable()->constrained('users'); // Ini admin yg approve
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
