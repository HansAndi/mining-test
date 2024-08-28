<?php

namespace App\Enums;

enum Approval: int
{
    case Approve = 1;
    case Reject = 2;

    public function getApproval(): string
    {
        return match ($this) {
            self::Approve => 'Approve',
            self::Reject => 'Reject',
        };
    }

    public function getValue(): int
    {
        return match ($this) {
            self::Approve => 1,
            self::Reject => 2,
        };
    }

    public static function getOptions(): array
    {
        return [
            ['value' => self::Approve->getValue(), 'name' => self::Approve->getApproval()],
            ['value' => self::Reject->getValue(), 'name' => self::Reject->getApproval()],
        ];
    }
}
