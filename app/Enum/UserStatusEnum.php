<?php

namespace App\Enum;

enum UserStatusEnum : string
{
    case ACTIVE = "Active";
    case INACTIVE = "Inactive";
    case DECEASED = "Deceased";

    public function toString(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::DECEASED => 'Deceased',
        };
    }
}
