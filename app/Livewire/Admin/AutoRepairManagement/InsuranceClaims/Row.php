<?php

namespace App\Livewire\Admin\AutoRepairManagement\InsuranceClaims;

use App\Models\AutoRepairManagement\InsuranceClaim;
use Livewire\Component;

class Row extends Component { public InsuranceClaim $item; public function render() { return view('livewire.admin.auto-repair-management.insurance-claims.row'); } }