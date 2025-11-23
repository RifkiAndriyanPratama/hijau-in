<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanStatusLog extends Model
{
    protected $guarded = [];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}