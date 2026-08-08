<?php

namespace App\Livewire\Front\CRM;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Relationship & Growth Hub')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.c-r-m.landing')->layout('components.layouts.front');
    }
}
