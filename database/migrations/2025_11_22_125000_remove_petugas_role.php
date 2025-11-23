<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Reassign any Petugas users to Admin before deleting role
        $petugasRole = DB::table('roles')->where('nama_role','Petugas')->first();
        $adminRole = DB::table('roles')->where('nama_role','Admin')->first();
        if ($petugasRole && $adminRole) {
            DB::table('users')->where('role_id',$petugasRole->id)->update(['role_id' => $adminRole->id]);
            DB::table('roles')->where('id',$petugasRole->id)->delete();
        }
    }

    public function down(): void
    {
        // Optionally recreate Petugas role (not reassigning users back)
        if (!DB::table('roles')->where('nama_role','Petugas')->exists()) {
            DB::table('roles')->insert([
                'nama_role' => 'Petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};
