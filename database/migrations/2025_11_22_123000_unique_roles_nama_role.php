<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Normalisasi: lowercase -> Title Case; hapus duplikat (keep smallest id)
        $roles = DB::table('roles')->select('id','nama_role')->get();
        $keepIds = [];
        foreach ($roles as $role) {
            $key = strtolower(trim($role->nama_role));
            $title = ucfirst($key);
            if (! isset($keepIds[$key])) {
                // First occurrence: normalize name
                DB::table('roles')->where('id',$role->id)->update(['nama_role' => $title]);
                $keepIds[$key] = $role->id;
            } else {
                // Duplicate: remove
                DB::table('roles')->where('id',$role->id)->delete();
            }
        }

        Schema::table('roles', function (Blueprint $table) {
            $table->unique('nama_role');
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropUnique(['nama_role']);
        });
        // (Optional) No rollback for deleted duplicates.
    }
};
