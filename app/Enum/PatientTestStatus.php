<?php

namespace App\Enum;

enum PatientTestStatus: string
{
    case PENDING = 'PENDING';
    case STARTED = 'STARTED';
    case COMPLETED = 'COMPLETED';

    public function toString(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::STARTED => 'Started',
            self::COMPLETED => 'Completed',
        };
    }
}
