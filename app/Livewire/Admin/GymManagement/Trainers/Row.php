<?php

namespace App\Livewire\Admin\GymManagement\Trainers;

use App\Models\GymManagement\Trainer;
use Livewire\Component;

class Row extends Component { public Trainer $item; public function render() { return view('livewire.admin.gym-management.trainers.row'); } }