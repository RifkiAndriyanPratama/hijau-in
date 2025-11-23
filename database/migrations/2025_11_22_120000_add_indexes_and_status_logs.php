<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Indexes for laporan table
        Schema::table('laporan', function (Blueprint $table) {
            $table->index('status');
            $table->index('pelapor_id');
            $table->index('petugas_id');
            $table->index('dinas_id');
        });

        // Status change log table
        Schema::create('laporan_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['pelapor_id']);
            $table->dropIndex(['petugas_id']);
            $table->dropIndex(['dinas_id']);
        });
        Schema::dropIfExists('laporan_status_logs');
    }
};