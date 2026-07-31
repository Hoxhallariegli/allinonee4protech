<?php

namespace App\Livewire\Admin\ConstructionERP\ProgressReports;

use App\Models\ConstructionERP\ProgressReport;
use Livewire\Component;

class Row extends Component { public ProgressReport $item; public function render() { return view('livewire.admin.construction-e-r-p.progress-reports.row'); } }