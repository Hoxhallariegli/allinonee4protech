<?php

namespace App\Livewire\Admin\PharmacyManagement\Medicines;

use App\Models\PharmacyManagement\Medicine;
use Livewire\Component;

class Row extends Component { public Medicine $item; public function render() { return view('livewire.admin.pharmacy-management.medicines.row'); } }