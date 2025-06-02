<?php

namespace App\Enum;

enum UserRolesEnum : string
{
	case USER = "User";
	case ADMIN = "Admin";
	case CARETAKER = "CareTaker";
	case PATIENT = "Patient";
	case SUPERADMIN = "SuperAdmin";
	

	public function toString(): string
	{
		return match ($this) {
			self::USER => 'User',
			self::ADMIN => 'Admin',
			self::CARETAKER => 'CareTaker',
			self::PATIENT => 'Patient',
			self::SUPERADMIN => 'SuperAdmin',
		};
	}
}
