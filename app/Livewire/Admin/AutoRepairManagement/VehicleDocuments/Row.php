<?php

namespace App\Livewire\Admin\AutoRepairManagement\VehicleDocuments;

use App\Models\AutoRepairManagement\VehicleDocument;
use Livewire\Component;

class Row extends Component { public VehicleDocument $item; public function render() { return view('livewire.admin.auto-repair-management.vehicle-documents.row'); } }