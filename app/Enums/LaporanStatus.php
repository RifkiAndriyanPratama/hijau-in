<?php

namespace App\Enums;

enum LaporanStatus: string
{
    case Pending = 'pending';
    case Disetujui = 'disetujui';
    case Dikerjakan = 'dikerjakan';
    case Selesai = 'selesai';

    public function next(): array
    {
        return match ($this) {
            self::Pending => [self::Disetujui],
            self::Disetujui => [self::Dikerjakan, self::Selesai],
            self::Dikerjakan => [self::Selesai],
            self::Selesai => [],
        };
    }

    public function canTransitionTo(self $target): bool
    {
        return in_array($target, $this->next(), true);
    }
}