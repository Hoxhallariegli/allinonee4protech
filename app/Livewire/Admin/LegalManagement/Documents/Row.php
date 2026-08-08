<?php

namespace App\Livewire\Admin\LegalManagement\Documents;

use App\Models\LegalManagement\Document;
use Livewire\Component;

class Row extends Component { public Document $item; public function render() { return view('livewire.admin.legal-management.documents.row'); } }