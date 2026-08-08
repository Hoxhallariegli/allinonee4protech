<?php

namespace App\Livewire\Front\Finance;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Capital & Strategic Finance')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.finance.landing')->layout('components.layouts.front');
    }
}
