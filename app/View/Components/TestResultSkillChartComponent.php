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
	public array $data;
	public array $categories;
	public function __construct(Collection $responseData)
	{
		$this->responseData = $responseData;

		$categoriesCollection = collect($this->responseData->get('skills'))->mapWithKeys(function ($item, $key) {
			return [collect($item)->get('key') => collect($item)->get('value')];
		});

		$this->data = (collect($categoriesCollection->all())->keys()->toArray());
		$this->categories = (collect($categoriesCollection->all())->values()->toArray());
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.test-result-skill-chart-component')->with(['data' => $this->data, 'categories' => $this->data]);;
    }
}
