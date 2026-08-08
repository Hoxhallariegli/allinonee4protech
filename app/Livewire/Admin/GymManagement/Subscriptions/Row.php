<?php

namespace App\Livewire\Admin\GymManagement\Subscriptions;

use App\Models\GymManagement\Subscription;
use Livewire\Component;

class Row extends Component { public Subscription $item; public function render() { return view('livewire.admin.gym-management.subscriptions.row'); } }