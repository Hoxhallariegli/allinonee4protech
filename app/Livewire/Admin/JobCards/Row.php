<?php

namespace App\Livewire\Admin\JobCards;

use App\Models\JobCard;
use Livewire\Component;

class Row extends Component { public JobCard $item; public function render() { return view('livewire.admin.job-cards.row'); } }