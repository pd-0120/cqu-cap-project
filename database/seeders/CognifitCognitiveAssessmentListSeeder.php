<?php

namespace Database\Seeders;

use App\Enum\TestTypeEnum;
use App\Models\CognifitAssessmentListTasks;
use App\Models\CognifitCognitiveAssessmentList;
use App\Models\CognitiveSkillsList;
use App\Models\CongnifitAssessmentListSkills;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use CognifitSdk\Api\Product;
use Illuminate\Support\Facades\Schema;

class CognifitCognitiveAssessmentListSeeder extends Seeder
{
    public $localesForAssets   = ['en'];
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        CognifitAssessmentListTasks::truncate();;
        CongnifitAssessmentListSkills::truncate();
        CognifitCognitiveAssessmentList::truncate();
        Schema::enableForeignKeyConstraints();

        $products  = new Product(env('COGNI_FIT_CLIENT_ID'));

        $this->storeAssessments($products);
        $this->storeAssessmentTask($products);
        $this->storeQuestionnaires($products);
        $this->storeTraining($products);
        $this->storeGame($products);

    }

    public function storeAssessments(Product $products)
    {
        try {
            $assessments = $products->getAssessments($this->localesForAssets);

            foreach ($assessments as $key => $assessment) {
                $tasks = $assessment->getTasks();
                $skills = $assessment->getSkills();
                $key = $assessment->getKey();
                $estimamtedTime = $assessment->getEstimatedTime();
                $assets = collect($assessment->getAssets());

                $title = $assets['titles']['en'];
                $description = $assets['descriptions']['en'];
                $image = $assets['images']['scareIconZodiac'];

                $cognifitCognitiveAssessment = new CognifitCognitiveAssessmentList();
                $cognifitCognitiveAssessment->title = $title;
                $cognifitCognitiveAssessment->description = $description;
                $cognifitCognitiveAssessment->image = $image;
                $cognifitCognitiveAssessment->estimated_time = $estimamtedTime;
                $cognifitCognitiveAssessment->key = $key;
                $cognifitCognitiveAssessment->type = TestTypeEnum::ASSESSMENT;
                $cognifitCognitiveAssessment->save();

                if (count($tasks) > 0) {
                    foreach ($tasks as $task) {
                        CognifitAssessmentListTasks::create(['name' => $task, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                    }
                }

                if (count($skills) > 0) {
                    foreach ($skills as $skill) {
                        CongnifitAssessmentListSkills::create(['name' => $skill, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function storeAssessmentTask(Product $products)
    {
        try {
            $assessmentTasks = $products->getAssessmentTasks($this->localesForAssets);

            foreach ($assessmentTasks as $key => $assessment) {
                $tasks = $assessment->getTasks();
                $skills = $assessment->getSkills();
                $key = $assessment->getKey();
                $estimamtedTime = $assessment->getEstimatedTime();
                $assets = collect($assessment->getAssets());

                $title = $assets['titles']['en'];
                $description = $assets['descriptions']['en'];
                $image = $assets['images']['scareIconZodiac'];

                $cognifitCognitiveAssessment = new CognifitCognitiveAssessmentList();
                $cognifitCognitiveAssessment->title = $title;
                $cognifitCognitiveAssessment->description = $description;
                $cognifitCognitiveAssessment->image = $image;
                $cognifitCognitiveAssessment->estimated_time = $estimamtedTime;
                $cognifitCognitiveAssessment->key = $key;
                $cognifitCognitiveAssessment->type = TestTypeEnum::ASSESSMENT;
                $cognifitCognitiveAssessment->save();

                if (count($tasks) > 0) {
                    foreach ($tasks as $task) {
                        CognifitAssessmentListTasks::create(['name' => $task, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                    }
                }

                if (count($skills) > 0) {
                    foreach ($skills as $skill) {
                        CongnifitAssessmentListSkills::create(['name' => $skill, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function storeQuestionnaires(Product $products)
    {
        $questionnaires = $products->getQuestionnaires($this->localesForAssets);

        foreach ($questionnaires as $key => $questionnairy) {
            $tasks = [];
            $skills = $questionnairy->getSkills();
            $key = $questionnairy->getKey();
            $estimamtedTime = 0;
            $assets = collect($questionnairy->getAssets());

            $title = $assets['titles']['en'];
            $description = $assets['descriptions']['en'];
            $image = array_key_exists('scareIconZodiac', $assets['images']) ? $assets['images']['scareIconZodiac'] : 'https://s3.amazonaws.com/dynamicimages.cognifit.com/storage/cognifit/training/321_6_UxMHiU';

            $cognifitCognitiveAssessment = new CognifitCognitiveAssessmentList();
            $cognifitCognitiveAssessment->title = $title;
            $cognifitCognitiveAssessment->description = $description;
            $cognifitCognitiveAssessment->image = $image;
            $cognifitCognitiveAssessment->estimated_time = $estimamtedTime;
            $cognifitCognitiveAssessment->key = $key;
            $cognifitCognitiveAssessment->type = TestTypeEnum::ASSESSMENT;
            $cognifitCognitiveAssessment->save();

            if (count($tasks) > 0) {
                foreach ($tasks as $task) {
                    CognifitAssessmentListTasks::create(['name' => $task, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                }
            }

            if (count($skills) > 0) {
                foreach ($skills as $skill) {
                    CongnifitAssessmentListSkills::create(['name' => $skill, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                }
            }
        }
    }

    public function storeTraining(Product $products) {
        $trainingPrograms = $products->getTraining($this->localesForAssets);

        foreach ($trainingPrograms as $key => $trainingProgram) {

            $tasks = $trainingProgram->getTasks();
            $skills = $trainingProgram->getSkills();
            $key = $trainingProgram->getKey();
            $estimamtedTime = 0;
            $assets = collect($trainingProgram->getAssets());

            $title = $assets['titles']['en'];
            $description = $assets['descriptions']['en'];
            $image = array_key_exists('scareIconZodiac', $assets['images']) ? $assets['images']['scareIconZodiac'] : 'https://s3.amazonaws.com/dynamicimages.cognifit.com/storage/cognifit/training/321_6_UxMHiU';

            $cognifitCognitiveAssessment = new CognifitCognitiveAssessmentList();
            $cognifitCognitiveAssessment->title = $title;
            $cognifitCognitiveAssessment->description = $description;
            $cognifitCognitiveAssessment->image = $image;
            $cognifitCognitiveAssessment->estimated_time = $estimamtedTime;
            $cognifitCognitiveAssessment->key = $key;
            $cognifitCognitiveAssessment->type = TestTypeEnum::TRAINING;
            $cognifitCognitiveAssessment->save();

            if (count($tasks) > 0) {
                foreach ($tasks as $task) {
                    CognifitAssessmentListTasks::create(['name' => $task, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                }
            }

            if (count($skills) > 0) {
                foreach ($skills as $skill) {
                    CongnifitAssessmentListSkills::create(['name' => $skill, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                }
            }
        }
    }

    public function storeGame(Product $products) {
        $games = $products->getGames($this->localesForAssets);

        foreach ($games as $key => $game) {
            $tasks = [];

            $skills = $game->getSkills();
            $key = $game->getKey();
            $estimamtedTime = 0;
            $assets = collect($game->getAssets());

            $title = $assets['titles']['en'];
            $description = $assets['descriptions']['en'];
            $image = $assets['images']['icon'];

            $cognifitCognitiveAssessment = new CognifitCognitiveAssessmentList();
            $cognifitCognitiveAssessment->title = $title;
            $cognifitCognitiveAssessment->description = $description;
            $cognifitCognitiveAssessment->image = $image;
            $cognifitCognitiveAssessment->estimated_time = $estimamtedTime;
            $cognifitCognitiveAssessment->key = $key;
            $cognifitCognitiveAssessment->type = TestTypeEnum::GAME;
            $cognifitCognitiveAssessment->save();

            if (count($tasks) > 0) {
                foreach ($tasks as $task) {
                    CognifitAssessmentListTasks::create(['name' => $task, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                }
            }

            if (count($skills) > 0) {
                foreach ($skills as $skill) {
                    CongnifitAssessmentListSkills::create(['name' => $skill, 'assessment_list_id' => $cognifitCognitiveAssessment->id]);
                }
            }
        }
    }
}
