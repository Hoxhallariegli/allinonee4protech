<?php

namespace App\Livewire\Admin\AutoRepairManagement\Services;

use App\Models\AutoRepairManagement\Service;
use Livewire\Component;

class Row extends Component { public Service $item; public function render() { return view('livewire.admin.auto-repair-management.services.row'); } }