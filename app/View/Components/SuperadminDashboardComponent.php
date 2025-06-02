<?php

namespace App\View\Components;

use App\Enum\UserRolesEnum;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SuperadminDashboardComponent extends Component
{
    public $adminCount = 0;
    public function __construct()
    {
        $this->adminCount = User::role(UserRolesEnum::ADMIN->value)->count();
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.superadmin-dashboard-component');
    }
}
