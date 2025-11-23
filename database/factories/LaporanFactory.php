<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Laporan;
use App\Models\User;
use App\Enums\LaporanStatus;

class LaporanFactory extends Factory
{
    protected $model = Laporan::class;

    public function definition(): array
    {
        $pelapor = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'pelapor_id' => $pelapor->id,
            'nama_pelapor' => $pelapor->name,
            'status' => LaporanStatus::Pending->value,
            'lokasi' => $this->faker->streetAddress(),
            'keterangan' => $this->faker->paragraph(),
            'petugas_id' => null,
            'dinas_id' => null,
        ];
    }
}