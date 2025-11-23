<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use App\Filament\Resources\LaporanResource;
use App\Models\FotoLaporan;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLaporan extends CreateRecord
{
    protected static string $resource = LaporanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set pelapor otomatis ke user yang login
        $data['pelapor_id'] = auth()->id();
        return $data;
    }

    protected function afterCreate(): void
    {
        $photos = $this->data['photos'] ?? [];
        if ($this->record && is_array($photos)) {
            foreach ($photos as $path) {
                if ($path) {
                    FotoLaporan::create([
                        'laporan_id' => $this->record->id,
                        'path_file' => $path,
                    ]);
                }
            }
        }
    }
}
