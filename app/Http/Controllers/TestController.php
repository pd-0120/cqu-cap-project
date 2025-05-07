<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientTest;
use App\Mail\TestReminderToPatientMail;
use App\Models\PatientTest;
use App\Models\Test;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$model = Test::query()->with('assessment');

			$model = $model->where('created_by', Auth::user()->id);

			return DataTables::eloquent($model)
				->addColumn('actions', function ($data) {
					return view('caretaker.test.action', compact('data'))->render();
				})
				->editColumn('assessment_list_id', function ($data) {
					return $data->assessment->title;
				})
				->rawColumns(['actions'])->make(true);
		}

		return view('caretaker.test.index');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('caretaker.test.create');
	}
	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Test $test)
	{
		if ($test->created_by !== auth()->user()->id) {
			Session::flash('message.level', 'warning');
			Session::flash('message.content', 'You do not have permission to edit this test.');

			return redirect()->route('caretaker.tests.index');
		}
		return view('caretaker.test.edit', compact('test'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Test $test)
	{
		$test->delete();

		Session::flash('message.level', 'success');
		Session::flash('message.content', 'Test removed successfully.');

		return redirect()->back();
	}


	public function assignTest(User $patient)
	{
		$tests = Test::where('created_by', auth()->user()->id)->get();

		return view('caretaker.test.assign-test', compact('patient', 'tests'));
	}

	public function storeAssignTest(StorePatientTest $request, User $patient)
	{

		$pendingPatientTest = PatientTest::where('patient_id', $patient->id)->where('test_id', $request['test_id'])->whereNot('status', 'COMPLETED')->first();

		if (!$pendingPatientTest) {
			PatientTest::create([
				'patient_id' => $patient->id,
				'assigned_by' => auth()->user()->id,
				'test_id' => $request['test_id'],
				'score' => 0,
				'assign_for_date' => Carbon::today(),
				'due_date' => Carbon::parse($request['due_date']),
			]);

			Session::flash('message.level', 'success');
			Session::flash('message.content', 'Test successfully assigned to patient.');
		} else {
			Session::flash('message.level', 'danger');
			Session::flash('message.content', 'The test is already <b>Pending</b>. Please <b> send the reminider </b> insted to patient to finish the test.');
		}


		return redirect()->route('caretaker.tests.index');
	}

	public function assignTestIndex(Request $request)
	{
		if ($request->ajax()) {
			$model = PatientTest::query()->with('patient', 'assignedBy', 'test');

			$model = $model->where('assigned_by', auth()->user()->id);


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
					return view('caretaker.test.assigned-tests-action', compact('data'))->render();
				})
				->rawColumns(['actions'])->make(true);
		}
		return view('caretaker.test.assigned-tests-index');
	}

	public function deleteAssignTest(PatientTest $assignTest)
	{
		$assignTest->delete();

		Session::flash('message.level', 'success');
		Session::flash('message.content', 'The assigned test has been removed successfully.');

		return redirect()->back();
	}

    public function sendTestReminder(PatientTest $test)
    {
        if($test->assigned_by !== auth()->user()->id) {
            Session::flash('message.level', 'warning');
            Session::flash('message.content', 'You do not have permission to send reminder to this patient.');
        }

        Mail::to($test->patient->email)
            ->send(new TestReminderToPatientMail($test));

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'The reminder has been sent to patient.');
        return redirect()->back();
    }
}
