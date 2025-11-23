<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class FotoLaporan extends Model
{
    protected $guarded = [];
    // Sesuaikan dengan nama tabel di migration (foto_laporan)
    protected $table = 'foto_laporan';

    // Jenis: awal | bukti
    protected $casts = [
        'jenis' => 'string',
    ];

public function laporan(): BelongsTo
{
    return $this->belongsTo(Laporan::class);
}
}
