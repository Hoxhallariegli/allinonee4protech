<?php

namespace App\Livewire\Admin\CRM\Deals;

use App\Models\CRM\Deal;
use Livewire\Component;

class Row extends Component { public Deal $item; public function render() { return view('livewire.admin.c-r-m.deals.row'); } }