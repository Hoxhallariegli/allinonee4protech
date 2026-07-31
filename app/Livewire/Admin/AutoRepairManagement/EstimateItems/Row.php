<?php

namespace App\Livewire\Admin\AutoRepairManagement\EstimateItems;

use App\Models\AutoRepairManagement\EstimateItem;
use Livewire\Component;

class Row extends Component { public EstimateItem $item; public function render() { return view('livewire.admin.auto-repair-management.estimate-items.row'); } }