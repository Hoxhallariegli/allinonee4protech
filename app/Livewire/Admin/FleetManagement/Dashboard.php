<?php

namespace App\Livewire\Admin\FleetManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('FleetManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['drivers'] = collect(range(6, 0))->map(fn($i) => \App\Models\FleetManagement\Driver::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['fuelLogs'] = collect(range(6, 0))->map(fn($i) => \App\Models\FleetManagement\FuelLog::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['shipments'] = collect(range(6, 0))->map(fn($i) => \App\Models\FleetManagement\Shipment::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['trips'] = collect(range(6, 0))->map(fn($i) => \App\Models\FleetManagement\Trip::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['vehicles'] = collect(range(6, 0))->map(fn($i) => \App\Models\FleetManagement\Vehicle::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.fleet-management.dashboard', [
            'stats' => [
            'drivers' => \App\Models\FleetManagement\Driver::count(),
            'fuelLogs' => \App\Models\FleetManagement\FuelLog::count(),
            'shipments' => \App\Models\FleetManagement\Shipment::count(),
            'trips' => \App\Models\FleetManagement\Trip::count(),
            'vehicles' => \App\Models\FleetManagement\Vehicle::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}