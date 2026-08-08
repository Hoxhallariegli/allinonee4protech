<?php

namespace App\Livewire\Admin\FacilityManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('FacilityManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['buildings'] = collect(range(6, 0))->map(fn($i) => \App\Models\FacilityManagement\Building::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['maintenanceRequests'] = collect(range(6, 0))->map(fn($i) => \App\Models\FacilityManagement\MaintenanceRequest::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['technicians'] = collect(range(6, 0))->map(fn($i) => \App\Models\FacilityManagement\Technician::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.facility-management.dashboard', [
            'stats' => [
            'buildings' => \App\Models\FacilityManagement\Building::count(),
            'maintenanceRequests' => \App\Models\FacilityManagement\MaintenanceRequest::count(),
            'technicians' => \App\Models\FacilityManagement\Technician::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}