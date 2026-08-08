<?php

namespace App\Livewire\Admin\HumanResources;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('HumanResources Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['attendances'] = collect(range(6, 0))->map(fn($i) => \App\Models\HumanResources\Attendance::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['departments'] = collect(range(6, 0))->map(fn($i) => \App\Models\HumanResources\Department::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['employees'] = collect(range(6, 0))->map(fn($i) => \App\Models\HumanResources\Employee::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['leaveRequests'] = collect(range(6, 0))->map(fn($i) => \App\Models\HumanResources\LeaveRequest::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['payrolls'] = collect(range(6, 0))->map(fn($i) => \App\Models\HumanResources\Payroll::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.human-resources.dashboard', [
            'stats' => [
            'attendances' => \App\Models\HumanResources\Attendance::count(),
            'departments' => \App\Models\HumanResources\Department::count(),
            'employees' => \App\Models\HumanResources\Employee::count(),
            'leaveRequests' => \App\Models\HumanResources\LeaveRequest::count(),
            'payrolls' => \App\Models\HumanResources\Payroll::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}