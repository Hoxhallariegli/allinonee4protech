<?php

namespace App\Livewire\Admin\RealEstateCRM;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('RealEstateCRM Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['agents'] = collect(range(6, 0))->map(fn($i) => \App\Models\RealEstateCRM\Agent::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['clients'] = collect(range(6, 0))->map(fn($i) => \App\Models\RealEstateCRM\Client::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['clientAddresses'] = collect(range(6, 0))->map(fn($i) => \App\Models\RealEstateCRM\ClientAddress::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['contracts'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\RealEstateCRM\Contract::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['owners'] = collect(range(6, 0))->map(fn($i) => \App\Models\RealEstateCRM\Owner::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['payments'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\RealEstateCRM\Payment::whereDate('created_at', now()->subDays($i))->sum('amount'))->toArray();
        $chartData['properties'] = collect(range(6, 0))->map(fn($i) => (float) \App\Models\RealEstateCRM\Property::whereDate('created_at', now()->subDays($i))->sum('price'))->toArray();
        $chartData['propertyVisits'] = collect(range(6, 0))->map(fn($i) => \App\Models\RealEstateCRM\PropertyVisit::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.real-estate-c-r-m.dashboard', [
            'stats' => [
            'agents' => \App\Models\RealEstateCRM\Agent::count(),
            'clients' => \App\Models\RealEstateCRM\Client::count(),
            'clientAddresses' => \App\Models\RealEstateCRM\ClientAddress::count(),
            'contracts' => \App\Models\RealEstateCRM\Contract::count(),
            'contracts_sum' => (float) \App\Models\RealEstateCRM\Contract::sum('amount'),
            'owners' => \App\Models\RealEstateCRM\Owner::count(),
            'payments' => \App\Models\RealEstateCRM\Payment::count(),
            'payments_sum' => (float) \App\Models\RealEstateCRM\Payment::sum('amount'),
            'properties' => \App\Models\RealEstateCRM\Property::count(),
            'properties_sum' => (float) \App\Models\RealEstateCRM\Property::sum('price'),
            'propertyVisits' => \App\Models\RealEstateCRM\PropertyVisit::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}