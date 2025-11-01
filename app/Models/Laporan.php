<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $guarded = [];

public function pelapor(): BelongsTo
{
    return $this->belongsTo(User::class, 'pelapor_id');
}

public function petugas(): BelongsTo
{
    return $this->belongsTo(User::class, 'petugas_id');
}

public function dinas(): BelongsTo
{
    return $this->belongsTo(User::class, 'dinas_id');
}

public function fotoLaporan(): HasMany
{
    return $this->hasMany(FotoLaporan::class);
}
}
