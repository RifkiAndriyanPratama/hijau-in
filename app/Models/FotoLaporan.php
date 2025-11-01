<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class FotoLaporan extends Model
{
    protected $guarded = [];

public function laporan(): BelongsTo
{
    return $this->belongsTo(Laporan::class);
}
}
