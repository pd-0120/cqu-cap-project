<?php

namespace App\Http\Controllers\Patient;

use App\Enum\PatientTestStatus;
use App\Enum\TestTypeEnum;
use App\Http\Controllers\CongnitiveFitController;
use App\Http\Controllers\Controller;
use App\Models\PatientTest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TestController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(Request $request) {
		if ($request->ajax()) {
			$model = PatientTest::query()->with('patient', 'assignedBy', 'test');
			if($request->status) {
				$model =	$model->where('status', $request->status);
			}
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
				->editColumn('status', function ($data) {
					$status = $data->status;
					if($status == PatientTestStatus::PENDING->name) {
						$status = '<span class="label font-weight-bold label-lg  label-light-warning label-inline">'. PatientTestStatus::PENDING->toString() .'</span>';
					} elseif($status == PatientTestStatus::STARTED->name) {
						$status = '<span class="label font-weight-bold label-lg  label-light-primary label-inline">'. PatientTestStatus::STARTED->toString() .'</span>';
					} else {
						$status = '<span class="label font-weight-bold label-lg  label-light-success label-inline">'. PatientTestStatus::COMPLETED->toString() .'</span>';
					}
					return $status;
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
				->rawColumns(['actions', 'status'])->make(true);
		}
		return view('patient.test.index');
	}

    public function takeTest(PatientTest $test)
	{
        if($test->status === PatientTestStatus::COMPLETED->name) {
            Session::flash('message.level', 'warning');
            Session::flash('message.content', 'You can not take the same test again.');

            return redirect()->route('patient.tests.index');
        }
		$test->update([
			'status' => 'STARTED'
		]);

		$congnitiveFitController = new CongnitiveFitController();
		$jsVersion = $congnitiveFitController->getCognifitJSversion();
		$user = auth()->user();

		$userAccessToken = $congnitiveFitController->getUserAccessToken($user);
		$userAccessToken = $userAccessToken->getData()['access_token'];

		$clientId = config("app.cognifit.client");

		$type = $test->test->test_type == TestTypeEnum::GAME->name ? "gameMode" : ($test->test->test_type == TestTypeEnum::ASSESSMENT->name ? "assessmentMode" : "trainingMode");
		
		$task = $test->test->assessment->key;

		return view('patient.test.play', compact('userAccessToken', 'test', 'type', 'task', 'clientId', 'jsVersion'));
	}

}
