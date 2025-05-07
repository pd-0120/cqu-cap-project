<?php

namespace App\Http\Controllers;

use App\Models\PatientTest;
use App\Models\PatientTestResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;


class PatientTestResultController extends Controller
{
    public function getResult(PatientTest $test, Request $request) {
        return view('patient.test.result');
    }

    public function updateTestResult(PatientTest $test, Request $request) : string
    {
        $testData = $request->data;

        $testStatus = $testData['status'];
        $testMode = $testData['mode'];
        $testKey = $testData['key'];

        if ($testStatus == 'completed') {
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
        return Blade::render('patient.test.pre-test-result', compact('test', 'testStatus', 'testMode', 'testKey'));
        // $test->update([
        // 	'taken_date' => Carbon::now(),
        // 	'status' => 'COMPLETED',
        // 	'result' => json_encode($request->all())
        // ]);

        // return response()->json(['success' => true]);
    }
}
