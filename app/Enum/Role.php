<?php

namespace App\Enums;

enum Role: int
{
    case Admin = 1;
    case Pool = 2;
    case Leader = 3;
    case Driver = 4;
    case Employee = 5;

    public function getRole(): string
    {
        return match ($this) {
            self::Admin => 'Pending',
            self::Pool => 'On Loan',
            self::Leader => 'Leader',
            self::Driver => 'Driver',
            self::Employee => 'Employee',
        };
    }

    public static function getOptions(): array
    {
        return [
            ['value' => self::Admin, 'status' => self::Admin->getRole()],
            ['value' => self::Pool, 'status' => self::Pool->getRole()],
            ['value' => self::Leader, 'status' => self::Leader->getRole()],
            ['value' => self::Driver, 'status' => self::Driver->getRole()],
            ['value' => self::Employee, 'status' => self::Employee->getRole()],
        ];
    }
}
