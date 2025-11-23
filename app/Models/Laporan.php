<?php

namespace App\Models;

use App\Enums\LaporanStatus;
use App\Models\LaporanStatusLog;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\LaporanStatusChanged;
use Illuminate\Support\Facades\Notification;

class Laporan extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    public const TIPE_MASALAH = [
        'sampah',
        'pencemaran_air',
        'pencemaran_udara',
        'penebangan_liar',
        'lainnya',
    ];

    protected $table = 'laporan';

    protected $casts = [
        'status' => LaporanStatus::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Laporan $laporan) {
            if (empty($laporan->nama_pelapor) && $laporan->pelapor_id) {
                $user = User::find($laporan->pelapor_id);
                if ($user) {
                    $laporan->nama_pelapor = $user->name;
                }
            }
        });

        static::updating(function (Laporan $laporan) {
            if ($laporan->isDirty('status')) {
                $oldRaw = $laporan->getOriginal('status');
                $oldEnum = $oldRaw instanceof LaporanStatus ? $oldRaw : LaporanStatus::tryFrom($oldRaw);
                $current = $laporan->status;
                $newEnum = $current instanceof LaporanStatus ? $current : LaporanStatus::tryFrom($current);

                if ($oldEnum && $newEnum && !$oldEnum->canTransitionTo($newEnum)) {
                    throw new \RuntimeException('Transisi status tidak diizinkan.');
                }

                $old = $oldEnum ? $oldEnum->value : (is_string($oldRaw) ? $oldRaw : (method_exists($oldRaw,'value') ? $oldRaw->value : (string) $oldRaw));
                $new = $newEnum ? $newEnum->value : (is_string($current) ? $current : (method_exists($current,'value') ? $current->value : (string) $current));

                LaporanStatusLog::create([
                    'laporan_id' => $laporan->id,
                    'user_id' => auth()->id(),
                    'old_status' => $old,
                    'new_status' => $new,
                ]);

                foreach ([$laporan->pelapor, $laporan->petugas, $laporan->dinas] as $notifyTarget) {
                    if ($notifyTarget) {
                        Notification::send($notifyTarget, new LaporanStatusChanged($laporan, $old, $new));
                    }
                }
            }
        });

        static::created(function (Laporan $laporan) {
            // Notify Admin & Superadmin for new laporan
            $targets = User::whereHas('role', fn($q) => $q->whereIn('nama_role', ['Admin','Superadmin']))->get();
            if ($targets->isNotEmpty()) {
                Notification::send($targets, new \App\Notifications\LaporanCreated($laporan));
            }
        });
    }

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

    public function statusLogs(): HasMany
    {
        return $this->hasMany(LaporanStatusLog::class);
    }

    public function group(): BelongsTo
    {
        // Fitur grup dihapus
        return $this->belongsTo(User::class)->whereRaw('1=0');
    }
}
