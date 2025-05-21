<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Contracts\Activity;

class ActivityController extends Controller
{
	/**
	 * @throws Exception
	 */
	public function index(Request $request) {
		if($request->ajax()) {
			$model = \Spatie\Activitylog\Models\Activity::query();

			return DataTables::eloquent($model)
				->editColumn('created_at', function ($data) {
					return $data->created_at->toDateTimeString();
				})
				->editColumn('description', function ($data) {
					$description = $data->description;

					if($description == 'created') {
						$status = '<span class="label font-weight-bold label-lg  label-light-success label-inline">Created</span>';
					} elseif($description == 'updated') {
						$status = '<span class="label font-weight-bold label-lg  label-light-primary label-inline">Updated</span>';
					} else {
						$status = '<span class="label font-weight-bold label-lg  label-light-danger label-inline">Deleted</span>';
					}
					return $status;
				})
				->editColumn('subject_type', function ($data) {
					return '<span class="font-weight-bold text-primary">'.$data->subject_type.'</span>';
				})
				->editColumn('causer_id', function ($data) {
					return $data->causer->full_name ?? null;
				})
				->rawColumns(['description', 'subject_type'])
				->make(true);
		}
		return view('admin.activity.index');
	}
}
