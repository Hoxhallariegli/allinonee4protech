<?php

namespace App\Livewire\Admin\LegalManagement\Billings;

use App\Models\LegalManagement\Billing;
use Livewire\Component;

class Row extends Component { public Billing $item; public function render() { return view('livewire.admin.legal-management.billings.row'); } }