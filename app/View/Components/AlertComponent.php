<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class AlertComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $content;
    public $level;

    public function __construct()
    {
        $this->level = Session::get('message.level');
        $this->content = Session::get('message.content');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert-component');
    }
}
