<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array(strtolower($user->role->nama_role ?? ''), ['superadmin','admin']);
    }

    public function view(User $user, User $target): bool
    {
        // Admin & Superadmin can view; user can view self
        if ($user->id === $target->id) return true;
        return in_array(strtolower($user->role->nama_role ?? ''), ['superadmin','admin']);
    }

    public function create(User $user): bool
    {
        // Only superadmin creates admin users; admin can create masyarakat
        $role = strtolower($user->role->nama_role ?? '');
        return in_array($role, ['superadmin','admin']);
    }

    public function update(User $user, User $target): bool
    {
        // Superadmin can update anyone; admin cannot update superadmin
        $role = strtolower($user->role->nama_role ?? '');
        $targetRole = strtolower($target->role->nama_role ?? '');
        if ($role === 'superadmin') return true;
        if ($role === 'admin' && $targetRole !== 'superadmin') return true;
        // user updating self (e.g., profile) allowed
        return $user->id === $target->id;
    }

    public function delete(User $user, User $target): bool
    {
        // Only superadmin may delete, and cannot delete another superadmin
        $role = strtolower($user->role->nama_role ?? '');
        $targetRole = strtolower($target->role->nama_role ?? '');
        return $role === 'superadmin' && $targetRole !== 'superadmin';
    }

    public function restore(User $user, User $target): bool
    {
        return $this->delete($user, $target);
    }

    public function forceDelete(User $user, User $target): bool
    {
        return $this->delete($user, $target);
    }
}
