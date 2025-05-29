<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewCaretakerRequest;
use App\Enum\UserRolesEnum;
use App\Enum\UserStatusEnum;
use App\Notifications\CaretakerApprovedNotification;
use App\Notifications\CaretakerRejectedNotification;

class CaretakerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = User::query()
                ->with('userDetail', 'roles')
                ->role(UserRolesEnum::CARETAKER->name);

            return DataTables::eloquent($model)
                ->addColumn('name', fn($data) => $data->first_name . ' ' . $data->last_name)
                ->addColumn('email', fn($data) => $data->email)
                ->addColumn('phone', fn($data) => $data->userDetail->phone ?? '-')
                ->addColumn('status', function ($data) {
                    if (!$data->userDetail) {
                        return '-';
                    }

                    $status = $data->userDetail->status;

                    if ($status == UserStatusEnum::ACTIVE->value) {
                        return '<span class="label font-weight-bold label-lg label-light-success label-inline">'
                            . UserStatusEnum::ACTIVE->toString() . '</span>';
                    } elseif ($status == UserStatusEnum::INACTIVE->value) {
                        return '<span class="label font-weight-bold label-lg label-light-primary label-inline">'
                            . UserStatusEnum::INACTIVE->toString() . '</span>';
                    } else {
                        return '<span class="label font-weight-bold label-lg label-light-danger label-inline">'
                            . UserStatusEnum::DECEASED->toString() . '</span>';
                    }
                })
                ->addColumn('actions', function ($data) {
                    return view('admin.caretakers.partials.actions', compact('data'))->render();
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.caretakers.index');
    }

    public function create()
    {
        return view('admin.caretakers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        $nameParts = explode(' ', $request->name, 2);

        $user = User::create([
            'first_name'  => $nameParts[0],
            'last_name'   => $nameParts[1] ?? '',
            'email'       => $request->email,
            'phone'       => $request->phone,
            'password'    => Hash::make($request->password),
            'role'        => UserRolesEnum::CARETAKER->name,
            'is_approved' => false,
        ]);

        // Notify Admin
        Mail::to(config('mail.admin_email'))->send(new NewCaretakerRequest($user));

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Caretaker created successfully. Awaiting approval.');

        return redirect()->route('admin.caretakers.index');
    }

    public function edit($id)
    {
        $caretaker = User::findOrFail($id);
        return view('admin.caretakers.edit', compact('caretaker'));
    }

    public function update(Request $request, $id)
    {
        $caretaker = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $caretaker->id,
            'phone'    => 'required|string|max:15',
            'password' => 'nullable|string|min:6',
        ]);

        $nameParts = explode(' ', $request->name, 2);

        $caretaker->update([
            'first_name' => $nameParts[0],
            'last_name'  => $nameParts[1] ?? '',
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => $request->password ? Hash::make($request->password) : $caretaker->password,
        ]);

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Caretaker updated successfully.');

        return redirect()->route('admin.caretakers.index');
    }

    public function destroy($id)
    {
        $caretaker = User::findOrFail($id);
        $caretaker->delete();

        Session::flash('message.level', 'danger');
        Session::flash('message.content', 'Caretaker deleted.');

        return redirect()->back();
    }

    public function approve($id)
    {
        \Log::info("Approving caretaker with ID: $id");

        $caretaker = User::findOrFail($id);
        $caretaker->update(['is_approved' => true]);

        // Send approval notification email
        $caretaker->notify(new CaretakerApprovedNotification());

        \Session::flash('message.level', 'success');
        \Session::flash('message.content', 'Caretaker approved.');

        return redirect()->back();
    }

    public function reject($id)
    {
        $caretaker = User::findOrFail($id);

        // Send rejection notification email
        $caretaker->notify(new CaretakerRejectedNotification());

        $caretaker->delete();

        Session::flash('message.level', 'warning');
        Session::flash('message.content', 'Caretaker request rejected and deleted.');

        return redirect()->back();
    }
}
