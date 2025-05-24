<?php

namespace App\Http\Controllers\Admin;

use App\Enum\PatientTestStatus;
use App\Enum\TestTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\PatientTest;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class TestController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Test::query()->with('createdBy', 'createdBy.roles', 'assessment');
            return DataTables::eloquent($model)
            ->editColumn('created_by', function ($data) {
                return $data->createdBy?->full_name;
            })
            ->addColumn('test_title', function ($data) {
                return $data->assessment?->title;
            })
            ->editColumn('test_type', function ($data) {
                    $type = $data->test_type;
                    if($type == TestTypeEnum::ASSESSMENT->name) {
                        $type = '<span><span class="label label-warning label-dot mr-2"></span><span class="font-weight-bold text-warning">'. TestTypeEnum::ASSESSMENT->toString() .'</span></span>';
                    } else if($type == TestTypeEnum::TRAINING->name) {
                        $type = '<span><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">'. TestTypeEnum::TRAINING->toString() .'</span></span>';
                    } else {
                        $type = '<span><span class="label label-primary label-dot mr-2"></span><span class="font-weight-bold text-primary">'. TestTypeEnum::GAME->toString() .'</span></span>';
                    }
                    return $type;
                })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->toDateString();
            })
            ->rawColumns(['test_type'])
            ->make(true);
        }

        // Logic to display all tests
        return view('Admin.tests.index');
    }
    public function assignTests(Request $request)
    {
        if ($request->ajax()) {
            $model = PatientTest::query()->with('assignedBy', 'assignedBy.roles', 'patient', 'patient.roles', 'test');
            return DataTables::eloquent($model)
            ->editColumn('patient_id', function ($data) {
					return $data->patient?->full_name;
				})
				->editColumn('assigned_by', function ($data) {
					return $data->assignedBy?->full_name;
				})
				->editColumn('test_id', function ($data) {
					return $data->test?->name;
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
				->rawColumns(['status'])->make(true);
        }
        return view('Admin.tests.assign');
    }
    public function testResult(Request $request, $test)
    {
        // Logic to display the result of a specific test
        return view('Admin.tests.result', compact('test'));
    }
    public function patientTests(Request $request, $patient)
    {
        // Logic to display all tests for a specific patient
        return view('Admin.tests.patient', compact('patient'));
    }
}
