<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class Row extends Component { public Category $item; public function render() { return view('livewire.admin.categories.row'); } }