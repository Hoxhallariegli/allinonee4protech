<?php

namespace App\Livewire\Admin\AutoRepairManagement\Parts;

use App\Models\AutoRepairManagement\Part;
use Livewire\Component;

class Row extends Component { public Part $item; public function render() { return view('livewire.admin.auto-repair-management.parts.row'); } }