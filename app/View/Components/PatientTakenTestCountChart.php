<?php

namespace App\View\Components;

use App\Models\PatientTest;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PatientTakenTestCountChart extends Component
{
    /**
     * Create a new component instance.
     */
	public array $last30Days;
	public array $data;
	public function __construct()
    {
		$this->last30Days = collect(range(0, 29))->map(function ($i) {
			return Carbon::today()->subDays(29 - $i)->toDateString();
		})->toArray();

		$testCounts = PatientTest::selectRaw('DATE(taken_date) as date, COUNT(*) as total')
			->whereAssignedBy(auth()->user()->id)
			->whereIn('taken_date', $this->last30Days)
			->groupBy('date')
			->pluck('total', 'date');

		$this->data = collect($this->last30Days)->map(function ($date) use ($testCounts) {
			return  $testCounts[$date] ?? 0;
			return rand(0, 200);
		})->toArray();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.patient-taken-test-count-chart')->with(['data' => $this->data, 'last30Days' => $this->last30Days]);
    }
}
