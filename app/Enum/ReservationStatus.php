<?php

namespace App\Enums;

enum ReservationStatus: int
{
    case Pending = 1;
    case Approved = 2;
    case Rejected = 3;

    public function getStatus(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
        };
    }

    public static function getOptions(): array
    {
        return [
            ['value' => self::Pending, 'status' => self::Pending->getStatus()],
            ['value' => self::Approved, 'status' => self::Approved->getStatus()],
            ['value' => self::Rejected, 'status' => self::Rejected->getStatus()],
        ];
    }
}
