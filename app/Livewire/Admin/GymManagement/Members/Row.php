<?php

namespace App\Livewire\Admin\GymManagement\Members;

use App\Models\GymManagement\Member;
use Livewire\Component;

class Row extends Component { public Member $item; public function render() { return view('livewire.admin.gym-management.members.row'); } }