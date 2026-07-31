<?php

namespace App\Livewire\Admin\SchoolManagement\Exams;

use App\Models\SchoolManagement\Exam;
use Livewire\Component;

class Row extends Component { public Exam $item; public function render() { return view('livewire.admin.school-management.exams.row'); } }