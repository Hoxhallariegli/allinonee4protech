<?php

namespace App\Livewire\Admin\GymManagement\MembershipPlans;

use App\Models\GymManagement\MembershipPlan;
use Livewire\Component;

class Row extends Component { public MembershipPlan $item; public function render() { return view('livewire.admin.gym-management.membership-plans.row'); } }