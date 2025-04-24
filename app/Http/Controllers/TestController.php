<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
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
            ->editColumn('assessment_list_id', function($data) {
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
        if($test->created_by !== auth()->user()->id) {
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

    public function takeTest() {
        $congnitiveFitController = new CongnitiveFitController();
        $userAccessToken = $congnitiveFitController->getUserAccessToken();
        $userAccessToken = $userAccessToken->getData()['access_token'];
        $test = Test::find(3);
        $clientId = config("app.cognifit.client");

        $type = $test->test_type == "GAME" ? "gameMode" : ($test->test_type == "ASSESSMENT" ? "assessmentMode" : "trainingMode");
        $task = $test->assessment->key;

        return view('patient.assessment.play', compact('userAccessToken', 'test', 'type', 'task', 'clientId'));
    }
}
