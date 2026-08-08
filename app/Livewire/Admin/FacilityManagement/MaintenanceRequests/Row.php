<?php

namespace App\Livewire\Admin\FacilityManagement\MaintenanceRequests;

use App\Models\FacilityManagement\MaintenanceRequest;
use Livewire\Component;

class Row extends Component { public MaintenanceRequest $item; public function render() { return view('livewire.admin.facility-management.maintenance-requests.row'); } }