<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCardParts;

use App\Models\AutoRepairManagement\JobCardPart;
use Livewire\Component;

class Row extends Component { public JobCardPart $item; public function render() { return view('livewire.admin.auto-repair-management.job-card-parts.row'); } }