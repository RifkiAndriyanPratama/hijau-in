<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['nama_role' => 'Admin']); // ID = 1
        Role::create(['nama_role' => 'Petugas']); // ID = 2
        Role::create(['nama_role' => 'Masyarakat']); // ID = 3
    }
}