<?php

namespace App\Livewire\Admin\ECommerce\OrderItems;

use App\Models\ECommerce\OrderItem;
use Livewire\Component;

class Row extends Component { public OrderItem $item; public function render() { return view('livewire.admin.e--commerce.order-items.row'); } }