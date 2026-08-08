<?php

namespace App\Livewire\Admin\LegalManagement\Hearings;

use App\Models\LegalManagement\Hearing;
use Livewire\Component;

class Row extends Component { public Hearing $item; public function render() { return view('livewire.admin.legal-management.hearings.row'); } }