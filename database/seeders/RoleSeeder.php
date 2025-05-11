<?php

namespace Database\Seeders;

use App\Enum\UserRolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => UserRolesEnum::USER->value]);
        Role::create(['name' => UserRolesEnum::ADMIN->value]);
        Role::create(['name' => UserRolesEnum::CARETAKER->value]);
        Role::create(['name' => UserRolesEnum::PATIENT->value]);
    }
}
