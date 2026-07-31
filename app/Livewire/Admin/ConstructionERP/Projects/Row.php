<?php

namespace App\Livewire\Admin\ConstructionERP\Projects;

use App\Models\ConstructionERP\Project;
use Livewire\Component;

class Row extends Component { public Project $item; public function render() { return view('livewire.admin.construction-e-r-p.projects.row'); } }