<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Role;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        // Jika user yang dibuat adalah admin, kirim email verifikasi.
        $record = $this->record;
        if (method_exists($record,'sendEmailVerificationNotification') && $record->role && Str::lower($record->role->nama_role) === 'admin') {
            $record->sendEmailVerificationNotification();
        }
    }
}
