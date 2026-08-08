<?php

namespace App\Livewire\Admin\LegalManagement;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('LegalManagement Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $chartData = [];
        $chartData['billings'] = collect(range(6, 0))->map(fn($i) => \App\Models\LegalManagement\Billing::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['clients'] = collect(range(6, 0))->map(fn($i) => \App\Models\LegalManagement\Client::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['documents'] = collect(range(6, 0))->map(fn($i) => \App\Models\LegalManagement\Document::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['hearings'] = collect(range(6, 0))->map(fn($i) => \App\Models\LegalManagement\Hearing::whereDate('created_at', now()->subDays($i))->count())->toArray();
        $chartData['legalCases'] = collect(range(6, 0))->map(fn($i) => \App\Models\LegalManagement\LegalCase::whereDate('created_at', now()->subDays($i))->count())->toArray();

        return view('livewire.admin.legal-management.dashboard', [
            'stats' => [
            'billings' => \App\Models\LegalManagement\Billing::count(),
            'clients' => \App\Models\LegalManagement\Client::count(),
            'documents' => \App\Models\LegalManagement\Document::count(),
            'hearings' => \App\Models\LegalManagement\Hearing::count(),
            'legalCases' => \App\Models\LegalManagement\LegalCase::count(),
            ],
            'chartData' => $chartData,
            'days' => collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray()
        ]);
    }
}