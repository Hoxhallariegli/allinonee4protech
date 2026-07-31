<?php

namespace App\Livewire\Admin\RealEstateCRM\Properties;

use App\Models\RealEstateCRM\Property;
use Livewire\Component;

class Row extends Component { public Property $item; public function render() { return view('livewire.admin.real-estate-c-r-m.properties.row'); } }