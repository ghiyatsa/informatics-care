<?php

namespace App\Enums;

enum ReportStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Rejected = 'rejected';

    /**
     * Get all status values as array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get display label for status
     */
    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu',
            self::InProgress => 'Diproses',
            self::Completed => 'Selesai',
            self::Rejected => 'Ditolak',
        };
    }

    /**
     * Get badge color for status
     */
    public function badgeColor(): string
    {
        return match ($this) {
            self::Pending => 'yellow',
            self::InProgress => 'blue',
            self::Completed => 'green',
            self::Rejected => 'red',
        };
    }
}

