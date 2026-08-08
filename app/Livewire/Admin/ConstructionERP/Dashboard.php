<?php

namespace App\Livewire\Admin\ConstructionERP;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('ConstructionERP Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['apartments'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\Apartment::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['buildings'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\Building::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['clients'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\Client::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['clientAddresses'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\ClientAddress::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['contracts'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\ConstructionERP\Contract::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['employees'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\Employee::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['heavyMachineries'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\HeavyMachinery::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['materials'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\ConstructionERP\Material::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['payments'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\ConstructionERP\Payment::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['progressReports'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\ProgressReport::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['projects'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\Project::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['purchaseOrders'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\PurchaseOrder::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['subcontractors'] = collect(range(6, 0))->map(fn($i) => \App\Models\ConstructionERP\Subcontractor::whereDate('created_at', now()->subDays($i))->count())->toArray();

        $layout = request()->is('construction-e-r-p-module*') ? 'modules.ConstructionERP.Layouts.app' : 'components.layouts.app';
        

        return view('livewire.admin.construction-e-r-p.dashboard', [
            'stats' => [
            'apartments' => \App\Models\ConstructionERP\Apartment::count(),
            'buildings' => \App\Models\ConstructionERP\Building::count(),
            'clients' => \App\Models\ConstructionERP\Client::count(),
            'clientAddresses' => \App\Models\ConstructionERP\ClientAddress::count(),
            'contracts' => \App\Models\ConstructionERP\Contract::count(),
            'contracts_sum' => (float) \App\Models\ConstructionERP\Contract::sum('amount'),
            'employees' => \App\Models\ConstructionERP\Employee::count(),
            'heavyMachineries' => \App\Models\ConstructionERP\HeavyMachinery::count(),
            'materials' => \App\Models\ConstructionERP\Material::count(),
            'materials_sum' => (float) \App\Models\ConstructionERP\Material::sum('price'),
            'payments' => \App\Models\ConstructionERP\Payment::count(),
            'payments_sum' => (float) \App\Models\ConstructionERP\Payment::sum('amount'),
            'progressReports' => \App\Models\ConstructionERP\ProgressReport::count(),
            'projects' => \App\Models\ConstructionERP\Project::count(),
            'purchaseOrders' => \App\Models\ConstructionERP\PurchaseOrder::count(),
            'subcontractors' => \App\Models\ConstructionERP\Subcontractor::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}