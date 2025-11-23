<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Laporan;

class LaporanPolicy
{
    /** Determine whether the user can view any models. */
    public function viewAny(User $user): bool
    {
        return in_array(strtolower($user->role->nama_role ?? ''), ['superadmin', 'admin']);
    }

    /** Determine whether the user can view the model. */
    public function view(User $user, Laporan $laporan): bool
    {
        if (strtolower($user->role->nama_role ?? '') === 'masyarakat') {
            return $laporan->pelapor_id === $user->id;
        }
        return in_array(strtolower($user->role->nama_role ?? ''), ['superadmin', 'admin']);
    }

    /** Determine whether the user can create models. */
    public function create(User $user): bool
    {
        return true; // everyone (including masyarakat) can create laporan
    }

    /** Determine whether the user can update the model. */
    public function update(User $user, Laporan $laporan): bool
    {
        $role = strtolower($user->role->nama_role ?? '');
        if ($role === 'superadmin') return true;
        if ($role === 'admin') return true;
        // pelapor can edit only when status is pending
        if ($role === 'masyarakat') {
            return $laporan->pelapor_id === $user->id && $laporan->status->value === 'pending';
        }
        return false;
    }

    /** Determine whether the user can delete the model. */
    public function delete(User $user, Laporan $laporan): bool
    {
        $role = strtolower($user->role->nama_role ?? '');
        return $role === 'superadmin' || $role === 'admin';
    }
}
