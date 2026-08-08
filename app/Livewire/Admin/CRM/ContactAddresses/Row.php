<?php

namespace App\Livewire\Admin\CRM\ContactAddresses;

use App\Models\CRM\ContactAddress;
use Livewire\Component;

class Row extends Component { public ContactAddress $item; public function render() { return view('livewire.admin.c-r-m.contact-addresses.row'); } }