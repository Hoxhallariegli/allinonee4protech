<?php

namespace App\Livewire\Front\GymManagement;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\GymManagement\MembershipPlan;
use App\Models\GymManagement\Trainer;

#[Title('The Power Station Gym')]
class Landing extends Component
{
    public function render()
    {
        return view('livewire.front.gym-management.landing', [
            'plans' => MembershipPlan::all(),
            'trainers' => Trainer::all(),
        ])->layout('components.layouts.front');
    }
}
