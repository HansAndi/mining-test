<?php

namespace App\Enums;

enum VehicleOwner: int
{
    case Company = 1;
    case Rental = 2;

    public function getOwnership(): string
    {
        return match ($this) {
            self::Company => 'Company',
            self::Rental => 'Rental',
        };
    }

    public static function getOptions(): array
    {
        return [
            ['value' => self::Company, 'name' => self::Company->getOwnership()],
            ['value' => self::Rental, 'name' => self::Rental->getOwnership()],
        ];
    }
}
