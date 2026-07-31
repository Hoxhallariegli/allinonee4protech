<?php

namespace App\Livewire\Admin\RealEstateCRM\Owners;

use App\Models\RealEstateCRM\Owner;
use Livewire\Component;

class Row extends Component { public Owner $item; public function render() { return view('livewire.admin.real-estate-c-r-m.owners.row'); } }