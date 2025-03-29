<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientRequest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Nette\Utils\Random;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $model = User::query()->with('userDetail');
    
            return DataTables::eloquent($model)->make(true);
        }

        return view('caretaker.patient.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caretaker.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePatientRequest $request)
    {
        $password = Random::generate(8);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'caretaker_id' => Auth::user()->id,
        ]);

        $user->assignRole('Patient');
        UserDetail::create([
            'user_id'=> $user->id,
            'emergency_contact' => $request->emergency_contact,
            'emergency_phone' => $request->emergency_phone,
            'medical_history' => $request->medical_history,
            'street' => $request->street,
            'suburb' => $request->suburb,
            'state' => $request->state,
        ]);

        Session::flash('message.level','success');
        Session::flash('message.content','Patient added successfully.');
        
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
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        Session::flash('message.level','success');
        Session::flash('message.content','Patient deleted successfully.');
        
        return redirect()->route('caretaker.patient.index');  
    }
}
