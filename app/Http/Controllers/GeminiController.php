<?php

namespace App\Http\Controllers;

use App\Models\CognifitCognitiveAssessmentList;
use App\Models\User;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;

class GeminiController extends Controller
{
    public function getGemini(User $patient)
    {
		$patientHistory = $patient->UserDetail->medical_history;

		$data = CognifitCognitiveAssessmentList::select('key', 'description', 'type')->limit(70)->get()->toJson();
		$result = Gemini::generativeModel(model: 'gemini-2.0-flash')->generateContent("Based on the Given JSON data $data .Suggest me a best test name and test type from given data for a patient with this medical history, just suggest me a test, nothing much in response: $patientHistory");

		return $result->text();
	}
}
