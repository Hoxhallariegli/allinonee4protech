<?php

namespace App\Livewire\Admin\CRM\Contacts;

use App\Models\CRM\Contact;
use Livewire\Component;

class Row extends Component { public Contact $item; public function render() { return view('livewire.admin.c-r-m.contacts.row'); } }