<?php

namespace App\Http\Controllers;

use App\Models\PatientTest;
use App\Models\PatientTestResult;
use App\Models\User;
use Illuminate\Http\Request;

class PatientTestResultController extends Controller
{
    public function getResult(Request $request)
    {

        $congnitiveFitController = new CongnitiveFitController();
        $user = User::find(auth()->user()->id);

        $result = $congnitiveFitController->getHistoricalScore($user);
        if (!$result->hasError()) {

            $data = $result->getData();
            $baseScore = $data['baseScore'];
            $user->userDetail()->update([
                'cognitive_score' => $baseScore
            ]);

            $score = collect($data['historicalScoreAndSkills'])->last();

            $patientTest = PatientTest::whereHas('test', function ($query) {
                $query->where('test_type', 'TRAINING')->where('status', 'STARTED')
                    ->whereHas('assessment', function ($q) {
                        $q->where('key', 'CHEMO_THERAPY_KIDS');
                    });
            })
                ->with(['test.assessment'])
                ->first();

            $patientTest->update([
                'score' => $score['score'],
                'status' => 'COMPLETED',
                'taken_date' => $score['date']
            ]);

            PatientTestResult::create([
                'patient_test_id' => $patientTest->id,
                'date' =>  $score['date'],
                'type_key' => $score['typeKey'],
                'type' => $score['type'],
                'cognitive_age' => $score['cognitiveAge']['age'],
                'cognitive_precision' => $score['cognitiveAge']['precision'],
                'score' =>   $score['score'],
                'response' =>  json_encode($score)
            ]);
        }
    }
}
