<?php

namespace App\Livewire\Admin\AutoRepairManagement\Reports;

use App\Models\AutoRepairManagement\Report;
use Livewire\Component;

class Row extends Component { public Report $item; public function render() { return view('livewire.admin.auto-repair-management.reports.row'); } }