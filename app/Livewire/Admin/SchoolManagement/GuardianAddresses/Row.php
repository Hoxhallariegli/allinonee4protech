<?php

namespace App\Livewire\Admin\SchoolManagement\GuardianAddresses;

use App\Models\SchoolManagement\GuardianAddress;
use Livewire\Component;

class Row extends Component { public GuardianAddress $item; public function render() { return view('livewire.admin.school-management.guardian-addresses.row'); } }