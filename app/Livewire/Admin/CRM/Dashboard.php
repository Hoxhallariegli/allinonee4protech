<?php

namespace App\Livewire\Admin\CRM;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('CRM Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['companies'] = collect(range(6, 0))->map(fn($i) => \App\Models\CRM\Company::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['contacts'] = collect(range(6, 0))->map(fn($i) => \App\Models\CRM\Contact::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['contactAddresses'] = collect(range(6, 0))->map(fn($i) => \App\Models\CRM\ContactAddress::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['deals'] = collect(range(6, 0))->map(fn($i) => \App\Models\CRM\Deal::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['interactions'] = collect(range(6, 0))->map(fn($i) => \App\Models\CRM\Interaction::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['leads'] = collect(range(6, 0))->map(fn($i) => \App\Models\CRM\Lead::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['tasks'] = collect(range(6, 0))->map(fn($i) => \App\Models\CRM\Task::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.c-r-m.dashboard', [
            'stats' => [
            'companies' => \App\Models\CRM\Company::count(),
            'contacts' => \App\Models\CRM\Contact::count(),
            'contactAddresses' => \App\Models\CRM\ContactAddress::count(),
            'deals' => \App\Models\CRM\Deal::count(),
            'interactions' => \App\Models\CRM\Interaction::count(),
            'leads' => \App\Models\CRM\Lead::count(),
            'tasks' => \App\Models\CRM\Task::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}