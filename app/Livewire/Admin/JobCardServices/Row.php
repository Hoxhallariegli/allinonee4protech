<?php

namespace App\Livewire\Admin\JobCardServices;

use App\Models\JobCardService;
use Livewire\Component;

class Row extends Component { public JobCardService $item; public function render() { return view('livewire.admin.job-card-services.row'); } }