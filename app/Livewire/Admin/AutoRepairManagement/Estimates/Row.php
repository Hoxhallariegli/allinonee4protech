<?php

namespace App\Livewire\Admin\AutoRepairManagement\Estimates;

use App\Models\AutoRepairManagement\Estimate;
use Livewire\Component;

class Row extends Component { public Estimate $item; public function render() { return view('livewire.admin.auto-repair-management.estimates.row'); } }