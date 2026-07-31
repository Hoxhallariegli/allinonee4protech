<?php

namespace App\Livewire\Admin\RealEstateCRM\Contracts;

use App\Models\RealEstateCRM\Contract;
use Livewire\Component;

class Row extends Component { public Contract $item; public function render() { return view('livewire.admin.real-estate-c-r-m.contracts.row'); } }