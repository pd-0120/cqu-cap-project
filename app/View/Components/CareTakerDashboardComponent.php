<?php

namespace App\View\Components;

use App\Models\Location;
use App\Models\PatientTest;
use App\Models\Test;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CareTakerDashboardComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $totalAssignedPatients;
    public $totalTests;
	public $totalLocations;
	public $totalAssignedTests;
    public function __construct()
    {
        $user = Auth::user();

        $this->totalAssignedPatients = User::where("caretaker_id", $user->id)->count();
        $this->totalTests = Test::where('created_by', $user->id)->count();
        $this->totalLocations = Location::where('created_by', $user->id)->count();
		$this->totalAssignedTests = PatientTest::whereAssignedBy($user->id)->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.care-taker-dashboard-component');
    }
}
