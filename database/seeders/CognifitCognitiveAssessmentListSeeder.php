<?php

namespace Database\Seeders;

use App\Models\CognifitCognitiveAssessmentList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use CognifitSdk\Api\Product;

class CognifitCognitiveAssessmentListSeeder extends Seeder
{
    public function run(): void
    {
        CognifitCognitiveAssessmentList::truncate();

        try {
            $localesForAssets   = ['en'];
            $products  = new Product(env('COGNI_FIT_CLIENT_ID'));
            
            $assessments = $products->getAssessments($localesForAssets);
            // dd($assessments);
            $assessmentTasks = $products->getAssessmentTasks($localesForAssets);
            // dd($assessmentTasks);
            $questionnaires = $products->getQuestionnaires($localesForAssets);
            // dd($questionnaires);
            $trainingPrograms = $products->getTraining($localesForAssets);
            // dd($trainingPrograms);
            $games = $products->getGames($localesForAssets);
            dd($games);


        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
