<?php

namespace App\View\Components;

use App\Enum\PatientTestStatus;
use App\Models\PatientTest;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PatientDashboardComponent extends Component
{
	public $totalTests = 0;
	public $totalPendingTests = 0;
	public $totalCompletedTests = 0;
	public $totalStartedTests = 0;

	public function __construct()
    {
		$this->totalTests 			= PatientTest::wherePatientId(auth()->user()->id)->count();
		$this->totalPendingTests 	= PatientTest::wherePatientId(auth()->user()->id)->whereStatus(PatientTestStatus::PENDING->name)->count();
		$this->totalCompletedTests 	= PatientTest::wherePatientId(auth()->user()->id)->whereStatus(PatientTestStatus::COMPLETED->name)->count();
		$this->totalStartedTests 	= PatientTest::wherePatientId(auth()->user()->id)->whereStatus(PatientTestStatus::STARTED->name)->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.patient-dashboard-component');
    }
}
