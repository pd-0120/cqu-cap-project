<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Mail\SendPasswordToPatientEmail;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Enum\UserStatusEnum;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Enum\UserRolesEnum;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = User::query()->with('userDetail' , 'roles');
			$model = $model->role(UserRolesEnum::ADMIN->name);

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
                    return view('superadmin.admin.action', compact('data'))->render();
                })
                ->rawColumns(['actions', 'user_detail.status'])->make(true);
        }

        return view('superadmin.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $australianStates = config('app.states');

        return view('superadmin.admin.create', compact('australianStates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
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
			'is_approved' => true,
		]);

		$user->assignRole(UserRolesEnum::ADMIN->value);
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
		]);

		Mail::to($user->email)->send(new SendPasswordToPatientEmail($user, $password));

		Session::flash('message.level', 'success');
		Session::flash('message.content', 'Admin added successfully.');

		return redirect()->route('superadmin.admins.index');
    }
}
