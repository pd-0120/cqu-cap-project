<?php

namespace App\Enum;

enum TestTypeEnum : string
{
    case ASSESSMENT = "ASSESSMENT";
    case TRAINING = "TRAINING";
    case GAME = "GAME";

    public function toString(): string
    {
        return match ($this) {
            self::ASSESSMENT => 'Assessment',
            self::TRAINING => 'Training',
            self::GAME => 'Game',
        };
    }
}
