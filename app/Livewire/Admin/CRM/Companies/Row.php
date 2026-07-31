<?php

namespace App\Livewire\Admin\CRM\Companies;

use App\Models\CRM\Company;
use Livewire\Component;

class Row extends Component { public Company $item; public function render() { return view('livewire.admin.c-r-m.companies.row'); } }