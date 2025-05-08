<?php

namespace App\Http\Controllers;

use App\Enum\UserStatusEnum;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientDetailsRequest;
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
            $model = User::query()->with('userDetail');
            $model = $model->where('caretaker_id', Auth::user()->id);

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

        return view('caretaker.patient.create', compact('locations'));
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
            'caretaker_id' => Auth::user()->id,
            'secret_password' => $encryptedPassword
        ]);

        $user->assignRole('Patient');
        UserDetail::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'emergency_contact' => $request->emergency_contact,
            'emergency_phone' => $request->emergency_phone,
            'medical_history' => $request->medical_history,
            'street' => $request->street,
            'suburb' => $request->suburb,
            'state' => $request->state,
            'location_id' => $request->location_id,
        ]);

        Mail::to($user->email)->send(new SendPasswordToPatientEmail($user, $password));

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Patient added successfully.');

        return redirect()->route('caretaker.patient.index');
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

        if ($patient->caretaker_id == Auth::user()->id) {
            return view('caretaker.patient.edit', compact('patient', 'userDetail', 'locations'));
        } else {
            Session::flash('message.level', 'warning');
            Session::flash('message.content', 'You do not have permission to edit this user.');

            return redirect()->route('caretaker.patient.index');
        }
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

        return redirect()->route('caretaker.patient.index');
    }
}
