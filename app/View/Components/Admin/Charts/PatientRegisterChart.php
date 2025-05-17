<?php

namespace App\View\Components\Admin\Charts;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PatientRegisterChart extends Component
{
	public array $last30Days = [];
	public array $data = [];
    public function __construct()
    {
		$this->last30Days = collect(range(0, 29))->map(function ($i) {
			return Carbon::today()->subDays(29 - $i)->toDateString();
		})->toArray();
		// Step 1: Define date range
		$startDate = Carbon::now()->subDays(29)->startOfDay();
		$endDate = Carbon::now()->endOfDay();

		$userCounts = User::query()
			->selectRaw('DATE(created_at) as date, COUNT(*) as count')
			->whereBetween('created_at', [$startDate, $endDate])
			->groupByRaw('DATE(created_at)')
			->orderBy('date')
			->pluck('count', 'date');
		$this->data = collect($this->last30Days)->map(function ($date) use ($userCounts) {
			return  $userCounts[$date] ?? 0;
		})->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.charts.patient-register-chart')->with(['data' => $this->data, 'last30Days' => $this->last30Days]);
    }
}
