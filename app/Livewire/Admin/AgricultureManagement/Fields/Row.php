<?php

namespace App\Livewire\Admin\AgricultureManagement\Fields;

use App\Models\AgricultureManagement\Field;
use Livewire\Component;

class Row extends Component { public Field $item; public function render() { return view('livewire.admin.agriculture-management.fields.row'); } }