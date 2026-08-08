<?php

namespace App\Livewire\Admin\PharmacyManagement\PrescriptionItems;

use App\Models\PharmacyManagement\PrescriptionItem;
use Livewire\Component;

class Row extends Component { public PrescriptionItem $item; public function render() { return view('livewire.admin.pharmacy-management.prescription-items.row'); } }