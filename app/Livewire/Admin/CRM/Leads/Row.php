<?php

namespace App\Livewire\Admin\CRM\Leads;

use App\Models\CRM\Lead;
use Livewire\Component;

class Row extends Component { public Lead $item; public function render() { return view('livewire.admin.c-r-m.leads.row'); } }