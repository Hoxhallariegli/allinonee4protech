<?php

namespace App\Livewire\Admin\JobCardParts;

use App\Models\JobCardPart;
use Livewire\Component;

class Row extends Component { public JobCardPart $item; public function render() { return view('livewire.admin.job-card-parts.row'); } }