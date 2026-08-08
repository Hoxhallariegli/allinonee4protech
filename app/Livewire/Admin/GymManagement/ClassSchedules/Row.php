<?php

namespace App\Livewire\Admin\GymManagement\ClassSchedules;

use App\Models\GymManagement\ClassSchedule;
use Livewire\Component;

class Row extends Component { public ClassSchedule $item; public function render() { return view('livewire.admin.gym-management.class-schedules.row'); } }