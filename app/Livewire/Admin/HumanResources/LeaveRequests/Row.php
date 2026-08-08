<?php

namespace App\Livewire\Admin\HumanResources\LeaveRequests;

use App\Models\HumanResources\LeaveRequest;
use Livewire\Component;

class Row extends Component { public LeaveRequest $item; public function render() { return view('livewire.admin.human-resources.leave-requests.row'); } }