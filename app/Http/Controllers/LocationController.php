<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Location::query()->where('created_by', Auth::user()->id);
            // $model = $model->where('caretaker_id', Auth::user()->id);

            return DataTables::eloquent($model)->addColumn('actions', function ($data) {
                return view('caretaker.location.action', compact('data'))->render();
            })->rawColumns(['actions'])->make(true);
        }

        return view('caretaker.location.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   
        return view('caretaker.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        Location::create([
            'name'=> $request->name,
            'street'=> $request->street,
            'suburb'=> $request->suburb,
            'state'=> $request->state,
            'pincode'=> $request->pincode,
            'phone'=> $request->phone,
        ]);

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Location added successfully.');
        
        return redirect()->route('caretaker.location.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('caretaker.location.edit', compact('location'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update([
            'name'=> $request->name,
            'street'=> $request->street,
            'suburb'=> $request->suburb,
            'state'=> $request->state,
            'phone'=> $request->phone,
            'pincode'=> $request->pincode,
        ]);

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Location updated successfully.');

        return redirect()->route('caretaker.location.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Location removed successfully.');

        return redirect()->back();
    }
}
