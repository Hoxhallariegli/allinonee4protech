<?php

namespace App\Livewire\Front\LegalManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\LegalManagement\LegalCase;
use App\Models\LegalManagement\Hearing;

#[Title('Legal Management - Justice & Excellence')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.legal-management.landing', [
            'cases' => LegalCase::with('client')->latest()->take(6)->get(),
            'hearings' => Hearing::with('legalCase')->where('date', '>=', now())->orderBy('date')->take(4)->get(),
        ])->layout('components.layouts.front');
    }
}
