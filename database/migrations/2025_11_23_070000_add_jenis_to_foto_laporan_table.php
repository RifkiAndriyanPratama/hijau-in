<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('foto_laporan', 'jenis')) {
            Schema::table('foto_laporan', function (Blueprint $table) {
                $table->string('jenis')->default('awal')->after('path_file');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('foto_laporan', 'jenis')) {
            Schema::table('foto_laporan', function (Blueprint $table) {
                $table->dropColumn('jenis');
            });
        }
    }
};
