<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class U extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $superadminRole = DB::table('roles')->where('nama_role','Superadmin')->first();
        $adminRole = DB::table('roles')->where('nama_role','Admin')->first();

        // Daftar superadmin yang harus ada
        $superadmins = [
            ['name' => 'Rifki', 'email' => 'rifki@superadmin.dev'],
            ['name' => 'Taufik', 'email' => 'taufik@superadmin.dev'],
            ['name' => 'Rio',   'email' => 'rio@superadmin.dev'],
        ];

        if ($superadminRole) {
            foreach ($superadmins as $sa) {
                if (!DB::table('users')->where('email',$sa['email'])->exists()) {
                    DB::table('users')->insert([
                        'name' => $sa['name'],
                        'email' => $sa['email'],
                        'password' => Hash::make('superadmin@123'),
                        'role_id' => $superadminRole->id,
                        'email_verified_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        if ($adminRole && !DB::table('users')->where('email','admin@example.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'Admin Default',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin12345'),
                'role_id' => $adminRole->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
