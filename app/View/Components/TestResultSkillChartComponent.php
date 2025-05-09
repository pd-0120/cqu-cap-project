<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class TestResultSkillChartComponent extends Component
{
    /**
     * Create a new component instance.
     */
	public Collection $responseData;
	public function __construct(Collection $responseData)
	{
		$this->responseData = $responseData;
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.test-result-skill-chart-component');
    }
}
