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

    public function getValue(): int
    {
        return match ($this) {
            self::Available => 1,
            self::Unavailable => 2,
            self::Maintenance => 3,
        };
    }

    public static function getOptions(): array
    {
        return [
            ['value' => self::Available->getValue(), 'status' => self::Available->getStatus()],
            ['value' => self::Unavailable->getValue(), 'status' => self::Unavailable->getStatus()],
            ['value' => self::Maintenance->getValue(), 'status' => self::Maintenance->getStatus()],
        ];
    }
}
