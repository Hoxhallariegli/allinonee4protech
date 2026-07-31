<?php

namespace App\Livewire\Admin\CRM\Tasks;

use App\Models\CRM\Task;
use Livewire\Component;

class Row extends Component { public Task $item; public function render() { return view('livewire.admin.c-r-m.tasks.row'); } }