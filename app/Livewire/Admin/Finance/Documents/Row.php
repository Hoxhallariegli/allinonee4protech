<?php

namespace App\Livewire\Admin\Finance\Documents;

use App\Models\Finance\Document;
use Livewire\Component;

class Row extends Component { public Document $item; public function render() { return view('livewire.admin.finance.documents.row'); } }