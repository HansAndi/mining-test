<?php

namespace App\Enums;

enum VehicleStatus: int
{
    case Available = 1;
    case Unavailable = 2;
    case Maintenance = 3;

    public function getStatus(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Unavailable => 'Unavailable',
            self::Maintenance => 'Maintenance',
        };
    }

    public static function getOptions(): array
    {
        return [
            ['value' => self::Available, 'status' => self::Available->getStatus()],
            ['value' => self::Unavailable, 'status' => self::Unavailable->getStatus()],
            ['value' => self::Maintenance, 'status' => self::Maintenance->getStatus()],
        ];
    }
}
