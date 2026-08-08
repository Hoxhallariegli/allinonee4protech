<?php

namespace App\Livewire\Admin\AgricultureManagement\Crops;

use App\Models\AgricultureManagement\Crop;
use Livewire\Component;

class Row extends Component { public Crop $item; public function render() { return view('livewire.admin.agriculture-management.crops.row'); } }