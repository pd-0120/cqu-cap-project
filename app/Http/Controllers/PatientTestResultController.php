<?php

namespace App\Http\Controllers;

use App\Models\PatientTestResult;
use App\Models\User;
use Illuminate\Http\Request;

class PatientTestResultController extends Controller
{
    public function getResult(Request $request) {
        $congnitiveFitController = new CongnitiveFitController();
        $user = User::find(auth()->user()->id);
        
        $result = $congnitiveFitController->getHistoricalScore($user);
        if(!$result->hasError()) {
            $data = $result->getData();
            $baseScore = $data['baseScore'];
            $user->userDetail()->update([
                'cognitive_score' => $baseScore
            ]);
            
            $score = collect($data['historicalScoreAndSkills'])->last();

        }

    }
}
