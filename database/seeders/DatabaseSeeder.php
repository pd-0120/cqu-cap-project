<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
		$this->call(CognitiveSkillsListsSeeder::class);
		$this->call(CognifitCognitiveAssessmentListSeeder::class);
		\App\Models\Location::factory(40)->create();

		if(config('app.env') === 'local') {
			$this->call(FakeDataSeeder::class);
		}
	}
}
