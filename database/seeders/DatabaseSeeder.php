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
         \App\Models\Location::factory(20)->create();
        
         $this->call(RoleSeeder::class);
         $this->call(CognitiveSkillsListsSeeder::class);
         $this->call(CognifitCognitiveAssessmentListSeeder::class);
    }
}
