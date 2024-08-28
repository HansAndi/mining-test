<?php

namespace App\Enums;

enum VehicleType: int
{
    case Person = 1;
    case Cargo = 2;

    public function getType(): string
    {
        return match ($this) {
            self::Person => 'Person',
            self::Cargo => 'Cargo',
        };
    }

    public function getValue(): int
    {
        return match ($this) {
            self::Person => 1,
            self::Cargo => 2,
        };
    }

    public static function getOptions(): array
    {
        return [
            ['value' => self::Person, 'name' => self::Person->getType()],
            ['value' => self::Cargo, 'name' => self::Cargo->getType()],
        ];
    }
}
