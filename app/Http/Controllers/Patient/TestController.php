<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\CongnitiveFitController;
use App\Http\Controllers\Controller;
use App\Models\PatientTest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(Request $request) {
		if ($request->ajax()) {
			$model = PatientTest::query()->with('patient', 'assignedBy', 'test');

			$model = $model->where('patient_id', auth()->user()->id);

			return DataTables::eloquent($model)
				->editColumn('patient_id', function ($data) {
					return $data->patient->full_name;
				})
				->editColumn('assigned_by', function ($data) {
					return $data->assignedBy->full_name;
				})
				->editColumn('test_id', function ($data) {
					return $data->test->name;
				})
				->editColumn('assign_for_date', function ($data) {
					return Carbon::parse($data->assign_for_date)->toDateString();
				})
				->editColumn('taken_date', function ($data) {
					return $data->taken_date ? Carbon::parse($data->taken_date)->toDateString() : "Test not taken yet";

				})
				->editColumn('due_date', function ($data) {
					return Carbon::parse($data->due_date)->toDateString();
				})
				->addColumn('actions', function ($data) {
					return view('patient.test.action', compact('data'))->render();
				})
				->rawColumns(['actions'])->make(true);
		}
		return view('patient.test.index');
	}

    public function takeTest(PatientTest $test)
	{
		$test->update([
			'status' => 'STARTED'
		]);

		$congnitiveFitController = new CongnitiveFitController();
		$jsVersion = $congnitiveFitController->getCognifitJSversion();
		$user = auth()->user();

		$userAccessToken = $congnitiveFitController->getUserAccessToken($user);
		$userAccessToken = $userAccessToken->getData()['access_token'];

		$clientId = config("app.cognifit.client");

		$type = $test->test_type == "GAME" ? "gameMode" : ($test->test_type == "ASSESSMENT" ? "assessmentMode" : "trainingMode");

		$task = $test->test->assessment->key;

		return view('patient.test.play', compact('userAccessToken', 'test', 'type', 'task', 'clientId', 'jsVersion'));
	}


}
