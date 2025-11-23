<?php

namespace App\Filament\Resources\GroupResource\Pages;

use App\Filament\Resources\GroupResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use App\Models\User;

class CreateGroup extends CreateRecord
{
    protected static string $resource = GroupResource::class;

    protected function afterCreate(): void
    {
        $group = $this->record;
        $data = $this->form->getState();
        $authUser = auth()->user();
        $role = strtolower($authUser->role->nama_role ?? '');

        $group->users()->detach();

        if ($role === 'superadmin') {
            $admins = collect($data['group_admins'] ?? []);
            $members = collect($data['users'] ?? []);
            // Ensure admins included in membership
            $merged = $members->merge($admins)->unique();
            $sync = [];
            foreach ($merged as $userId) {
                $sync[$userId] = ['is_admin' => $admins->contains($userId)];
            }
            $group->users()->sync($sync);
        } elseif ($role === 'admin') {
            // Admin becomes group admin automatically
            $members = collect($data['users'] ?? []);
            $merged = $members->merge([$authUser->id])->unique();
            $sync = [];
            foreach ($merged as $userId) {
                $sync[$userId] = ['is_admin' => $userId == $authUser->id];
            }
            $group->users()->sync($sync);
        }
    }
}
