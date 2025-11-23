<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        collect(['Superadmin','Admin','Masyarakat'])
            ->each(fn($r)=> Role::firstOrCreate(['nama_role' => $r]));
    }
}