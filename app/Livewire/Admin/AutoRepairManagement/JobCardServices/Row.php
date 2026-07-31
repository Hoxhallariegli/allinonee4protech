<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCardServices;

use App\Models\AutoRepairManagement\JobCardService;
use Livewire\Component;

class Row extends Component { public JobCardService $item; public function render() { return view('livewire.admin.auto-repair-management.job-card-services.row'); } }