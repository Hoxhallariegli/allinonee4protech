<?php

namespace App\Livewire\Admin\ECommerce\Customers;

use App\Models\ECommerce\Customer;
use Livewire\Component;

class Row extends Component { public Customer $item; public function render() { return view('livewire.admin.e--commerce.customers.row'); } }