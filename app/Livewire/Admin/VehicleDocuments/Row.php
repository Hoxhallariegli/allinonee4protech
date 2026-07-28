<?php

namespace App\Livewire\Admin\VehicleDocuments;

use App\Models\VehicleDocument;
use Livewire\Component;

class Row extends Component { public VehicleDocument $item; public function render() { return view('livewire.admin.vehicle-documents.row'); } }