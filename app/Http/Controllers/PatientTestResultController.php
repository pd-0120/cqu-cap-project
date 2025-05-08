<?php

namespace App\Http\Controllers;

use App\Enum\PatientTestStatus;
use App\Models\PatientTest;
use App\Models\PatientTestResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;


class PatientTestResultController extends Controller
{
    public function getResult(PatientTest $test, Request $request) {
        $user = auth()->user();

        if($test->patient_id == $user->id || $test->assigned_by == $user->id) {
            if($test->status !== PatientTestStatus::COMPLETED->name) {
                Session::flash('message.level', 'warning');
                Session::flash('message.content', 'The test is not completed yet.');

                return redirect()->route('dashboard');
            }
            return view('patient.test.result');
        }
        Session::flash('message.level', 'warning');
        Session::flash('message.content', 'You can view result for this test.');

        return redirect()->route('dashboard');
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

                $score = collect($data['historicalScoreAndSkills'])->first();

                $test->update([
                    'score' => $score['score'],
                    'status' => 'COMPLETED',
                    'taken_date' => $score['date']
                ]);

                PatientTestResult::create([
                    'patient_test_id' => $test->id,
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
    }
}
