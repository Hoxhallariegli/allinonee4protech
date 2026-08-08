<?php

namespace App\Livewire\Admin\ECommerce\Vendors;

use App\Models\ECommerce\Vendor;
use Livewire\Component;

class Row extends Component { public Vendor $item; public function render() { return view('livewire.admin.e--commerce.vendors.row'); } }