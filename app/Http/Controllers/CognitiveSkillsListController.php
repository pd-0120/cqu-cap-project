<?php

namespace App\Http\Controllers;

use App\Models\CognifitCognitiveAssessmentList;
use Illuminate\Http\Request;

class CognitiveSkillsListController extends Controller
{
    public function getAvailableAssessments(Request $request)
    {
        $assessments = CognifitCognitiveAssessmentList::paginate(8);
     
        return view('caretaker.assessment.index', compact('assessments'));
    }

    public function viewAssessmentTask(Request $request, CognifitCognitiveAssessmentList $assessment)
    {
        $assessment = $assessment->whereId($assessment->id)->with(['getTasks', 'getSkills', 'getSkills.skill'])->first();

        return view('caretaker.assessment.view', compact('assessment'));
    }
}
