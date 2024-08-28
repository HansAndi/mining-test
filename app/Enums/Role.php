<?php

namespace App\Enums;

enum Role: int
{
    case Admin = 1;
    case Leader = 2;
    case Driver = 3;
    case Employee = 4;

    public function getRole(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Leader => 'Leader',
            self::Driver => 'Driver',
            self::Employee => 'Employee',
        };
    }

    public static function getOptions(): array
    {
        return [
            ['value' => self::Admin, 'status' => self::Admin->getRole()],
            ['value' => self::Leader, 'status' => self::Leader->getRole()],
            ['value' => self::Driver, 'status' => self::Driver->getRole()],
            ['value' => self::Employee, 'status' => self::Employee->getRole()],
        ];
    }
}
