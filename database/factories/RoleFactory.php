<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'nama_role' => $this->faker->unique()->randomElement(['Superadmin','Admin','Masyarakat']),
        ];
    }
}