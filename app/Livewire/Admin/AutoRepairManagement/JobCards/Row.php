<?php

namespace App\Livewire\Admin\AutoRepairManagement\JobCards;

use App\Models\AutoRepairManagement\JobCard;
use Livewire\Component;

class Row extends Component { public JobCard $item; public function render() { return view('livewire.admin.auto-repair-management.job-cards.row'); } }