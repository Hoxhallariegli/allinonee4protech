<?php

namespace App\Livewire\Admin\EstimateItems;

use App\Models\EstimateItem;
use Livewire\Component;

class Row extends Component { public EstimateItem $item; public function render() { return view('livewire.admin.estimate-items.row'); } }