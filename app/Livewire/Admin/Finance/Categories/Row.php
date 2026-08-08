<?php

namespace App\Livewire\Admin\Finance\Categories;

use App\Models\Finance\Category;
use Livewire\Component;

class Row extends Component { public Category $item; public function render() { return view('livewire.admin.finance.categories.row'); } }