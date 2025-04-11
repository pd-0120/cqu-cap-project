<?php

namespace Database\Seeders;

use App\Models\CognitiveSkillsList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use CognifitSdk\Api\Skills;

class CognitiveSkillsListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CognitiveSkillsList::truncate();



        try {
            $localesForAssets   = ['en'];
            $product  = new Skills(env('COGNI_FIT_CLIENT_ID'));
            $skills = $product->getSkills($localesForAssets);
            foreach ($skills as $skillKey => $skillValue) {
                $titles = collect($skillValue->getAssets())['titles']['en'];
                $descriptions = collect($skillValue->getAssets())['descriptions']['en'];
                $images = collect($skillValue->getAssets())['images']['whiteIcon'];

                $cognitiveSkillsList = new CognitiveSkillsList();
                $cognitiveSkillsList->key = $skillKey;
                $cognitiveSkillsList->title = $titles;
                $cognitiveSkillsList->description = $descriptions;
                $cognitiveSkillsList->image = $images;
                $cognitiveSkillsList->response_data = collect($skillValue->getAssets());
                $cognitiveSkillsList->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
