<?php

namespace App\View\Components;

use App\Enum\PatientTestStatus;
use App\Enum\UserRolesEnum;
use App\Models\Location;
use App\Models\PatientTest;
use App\Models\Test;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminDashboardComponent extends Component
{
	public $totalRegisteredCaretakers = 0;
	public $totalRegisteredPatients = 0;
	public $totalLocations = 0;
	public $totalTestCreated = 0;
	public $totalTestAssinged = 0;
	public $totalTestTaken = 0;
	public $totalTestMissed = 0;
    public function __construct()
    {
		$this->totalRegisteredCaretakers 	= User::role(UserRolesEnum::CARETAKER->value)->count();
		$this->totalRegisteredPatients 		= User::role(UserRolesEnum::PATIENT->value)->count();
		$this->totalLocations				= Location::count();
		$this->totalTestCreated				= Test::count();
		$this->totalTestAssinged			= PatientTest::count();
		$this->totalTestTaken				= PatientTest::whereStatus(PatientTestStatus::COMPLETED->value)->count();
		$this->totalTestMissed				= PatientTest::where('due_date', '>', today()->toDateString())->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-dashboard-component');
    }
}
