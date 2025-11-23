<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use App\Filament\Resources\LaporanResource;
use App\Models\FotoLaporan;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporan extends EditRecord
{
    protected static string $resource = LaporanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $photos = $this->data['photos'] ?? [];
        if (! is_array($photos)) {
            return;
        }
        $record = $this->record;
        // Ambil path yang sudah ada
        $existing = $record->fotoLaporan()->pluck('path_file')->all();
        $toDelete = array_diff($existing, $photos);
        if ($toDelete) {
            $record->fotoLaporan()->whereIn('path_file', $toDelete)->delete();
        }
        $toAdd = array_diff($photos, $existing);
        foreach ($toAdd as $path) {
            if ($path) {
                FotoLaporan::create([
                    'laporan_id' => $record->id,
                    'path_file' => $path,
                ]);
            }
        }
    }
}
