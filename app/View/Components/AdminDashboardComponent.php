<?php

namespace App\View\Components;

use App\Enum\PatientTestStatus;
use App\Enum\UserRolesEnum;
use App\Models\CognifitCognitiveAssessmentList;
use App\Models\Location;
use App\Models\PatientTest;
use App\Models\Test;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminDashboardComponent extends Component
{
	public int $totalRegisteredCaretakers = 0;
	public int $totalRegisteredPatients = 0;
	public int $totalLocations = 0;
	public int $totalTestCreated = 0;
	public int $totalTestAssigned = 0;
	public int $totalTestTaken = 0;
	public int $totalTestMissed = 0;
	public int $totalAvailableAssessments = 0;
	public int $totalTestsPending = 0;
    public function __construct()
    {
		$this->totalRegisteredCaretakers 	= User::role(UserRolesEnum::CARETAKER->value)->count();
		$this->totalRegisteredPatients 		= User::role(UserRolesEnum::PATIENT->value)->count();
		$this->totalLocations				= Location::count();
		$this->totalTestCreated				= Test::count();
		$this->totalTestAssigned			= PatientTest::count();
		$this->totalTestTaken				= PatientTest::whereStatus(PatientTestStatus::COMPLETED->value)->count();
		$this->totalTestsPending			= PatientTest::whereStatus(!PatientTestStatus::COMPLETED->value)->count();
		$this->totalAvailableAssessments	= CognifitCognitiveAssessmentList::count();
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
