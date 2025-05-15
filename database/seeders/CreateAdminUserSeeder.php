<?php

namespace Database\Seeders;

use App\Enum\UserRolesEnum;
use App\Enum\UserStatusEnum;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
		$password = "Caretaker@321";
		$hashPassword = Hash::make($password);
		$encryptedPassword = Crypt::encrypt($password);

        $data = [
			'first_name' => "Caretaker",
			'last_name' => "User",
			'email' => "caretaker@example.com",
			'password' => $hashPassword,
			'email_verified_at' => now(),
			'cognifit_user_token' => null,
			'secret_password' => $encryptedPassword,
			'dob' => now()->toDateString()
		];
		if(!User::whereEmail($data['email'])->exists()) {
			$user = User::create($data);
			$user->assignRole(UserRolesEnum::CARETAKER->value);
			UserDetail::create([
				'user_id' => $user->id,
				'status' => UserStatusEnum::ACTIVE->value,
			]);
		}

		$password = "Admin@321";
		$hashPassword = Hash::make($password);
		$encryptedPassword = Crypt::encrypt($password);

        $data = [
			'first_name' => "Admin",
			'last_name' => "User",
			'email' => "admin@example.com",
			'password' => $hashPassword,
			'email_verified_at' => now(),
			'cognifit_user_token' => null,
			'secret_password' => $encryptedPassword,
			'dob' => now()->toDateString()
		];
		if(!User::whereEmail($data['email'])->exists()) {
			$user = User::create($data);
			$user->assignRole(UserRolesEnum::ADMIN->value);
			UserDetail::create([
				'user_id' => $user->id,
				'status' => UserStatusEnum::ACTIVE->value,
			]);
		}
    }
}
