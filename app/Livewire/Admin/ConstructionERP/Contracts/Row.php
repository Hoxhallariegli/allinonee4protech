<?php

namespace App\Livewire\Admin\ConstructionERP\Contracts;

use App\Models\ConstructionERP\Contract;
use Livewire\Component;

class Row extends Component { public Contract $item; public function render() { return view('livewire.admin.construction-e-r-p.contracts.row'); } }