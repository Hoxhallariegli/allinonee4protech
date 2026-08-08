<?php

namespace App\Livewire\Admin\LegalManagement\LegalCases;

use App\Models\LegalManagement\LegalCase;
use Livewire\Component;

class Row extends Component { public LegalCase $item; public function render() { return view('livewire.admin.legal-management.legal-cases.row'); } }