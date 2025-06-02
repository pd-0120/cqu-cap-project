<?php

namespace App\Http\Controllers;

use App\Enum\UserRolesEnum;
use App\Enum\UserStatusEnum;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientDetailsRequest;
use App\Mail\CaretakerAssignEmailToPatient;
use App\Mail\PatientAssignEmailToCareTaker;
use App\Mail\SendPasswordToPatientEmail;
use App\Models\Location;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = User::query()->with('userDetail', 'caretaker', 'roles');
			$model = $model->role(UserRolesEnum::PATIENT->name);
            return DataTables::eloquent($model)
                ->editColumn('user_detail.status', function ($data) {
                    $status = $data->userDetail->status;

                    if($status == UserStatusEnum::ACTIVE->value) {
                        $status = '<span class="label font-weight-bold label-lg  label-light-success label-inline">'. UserStatusEnum::ACTIVE->toString() .'</span>';
                    } elseif($status == UserStatusEnum::INACTIVE->value) {
                        $status = '<span class="label font-weight-bold label-lg  label-light-primary label-inline">'. UserStatusEnum::INACTIVE->toString() .'</span>';
                    } else {
                        $status = '<span class="label font-weight-bold label-lg  label-light-danger label-inline">'. UserStatusEnum::DECEASED->toString() .'</span>';
                    }
                    return $status;
                })
				->editColumn('caretaker_id', function ($data) {
					return $data->caretaker ? $data->caretaker->full_name : null;
				})
                ->addColumn('actions', function ($data) {
                    return view('caretaker.patient.action', compact('data'))->render();
                })
                ->rawColumns(['actions', 'user_detail.status'])->make(true);
        }

        return view('caretaker.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
		$australianStates = config('app.states');

        return view('caretaker.patient.create', compact('locations', 'australianStates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePatientRequest $request)
    {
        $password = str()->password(8);
        $encryptedPassword = Crypt::encryptString($password);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'dob' => Carbon::parse($request->dob),
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'secret_password' => $encryptedPassword,
			'cognifit_user_token' => env('COGNI_FIT_USER_TOKEN', null),
            'is_approved' => true,
        ]);

        $user->assignRole(UserRolesEnum::PATIENT->value);
        UserDetail::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'emergency_contact' => $request->emergency_contact,
            'emergency_phone' => $request->emergency_phone,
            'medical_history' => $request->medical_history,
            'street' => $request->street,
            'gender' => $request->gender,
            'suburb' => $request->suburb,
            'state' => $request->state,
            'location_id' => $request->location_id,
        ]);

        Mail::to($user->email)->send(new SendPasswordToPatientEmail($user, $password));

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Patient added successfully.');

        return redirect()->route('admin.patient.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $patient)
    {
        $userDetail = $patient->userDetail;
        $locations = Location::all();
		$australianStates = config('app.states');

		return view('caretaker.patient.edit', compact('patient', 'userDetail', 'locations', 'australianStates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientDetailsRequest $request, User $patient)
    {
        $user = User::whereId($patient->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        UserDetail::whereUserId($patient->id)->update([
            'phone' => $request->phone,
            'emergency_contact' => $request->emergency_contact,
            'emergency_phone' => $request->emergency_phone,
            'gender' => $request->gender,
            'status' => $request->status,
            'medical_history' => $request->medical_history,
            'street' => $request->street,
            'suburb' => $request->suburb,
            'state' => $request->state,
            'location_id' => $request->location_id,
        ]);

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Patient updated successfully.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $patient)
    {
        $patient->delete();
        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Patient deleted successfully.');

        return redirect()->route('admin.patient.index');
    }

	public function  assignPatients(Request $request)
	{
		if ($request->ajax()) {
			$model = User::query()->with('userDetail');
			$model = $model->whereCaretakerId(auth()->user()->id);

			return DataTables::eloquent($model)
				->editColumn('user_detail.status', function ($data) {
					$status = $data->userDetail->status;

					if($status == UserStatusEnum::ACTIVE->value) {
						$status = '<span class="label font-weight-bold label-lg  label-light-success label-inline">'. UserStatusEnum::ACTIVE->toString() .'</span>';
					} elseif($status == UserStatusEnum::INACTIVE->value) {
						$status = '<span class="label font-weight-bold label-lg  label-light-primary label-inline">'. UserStatusEnum::INACTIVE->toString() .'</span>';
					} else {
						$status = '<span class="label font-weight-bold label-lg  label-light-danger label-inline">'. UserStatusEnum::DECEASED->toString() .'</span>';
					}
					return $status;
				})
				->addColumn('actions', function ($data) {
					return view('caretaker.patient.assign-patient-action', compact('data'))->render();
				})
				->rawColumns(['actions', 'user_detail.status'])->make(true);
		}

		return view('caretaker.patient.assign-patients');
	}

	public function assignCaretaker(User $patient) {
		$caretakers = User::select('id', 'first_name', 'last_name', 'email')->role(UserRolesEnum::CARETAKER->name)->where('is_approved', true)->get();

		return view('patient.assign-caretaker', compact('patient', 'caretakers'));
	}

	public function storeAssignCaretaker(Request $request, User $patient) {
		$patient->caretaker_id = $request->caretaker_id;
		$patient->save();

		$caretaker = User::find($request->caretaker_id);

		Mail::to($caretaker->email)->send(new PatientAssignEmailToCareTaker($patient, $caretaker));
		Mail::to($patient->email)->send(new CaretakerAssignEmailToPatient($patient, $caretaker));

		Session::flash('message.level', 'success');
		Session::flash('message.content', 'Care taker assigned successfully.');
		return redirect()->route('admin.patient.index');
	}
}
