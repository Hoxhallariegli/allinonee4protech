<?php

namespace App\Livewire\Admin\Estimates;

use App\Models\Estimate;
use Livewire\Component;

class Row extends Component { public Estimate $item; public function render() { return view('livewire.admin.estimates.row'); } }