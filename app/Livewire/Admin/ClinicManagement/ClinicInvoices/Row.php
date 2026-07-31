<?php

namespace App\Livewire\Admin\ClinicManagement\ClinicInvoices;

use App\Models\ClinicManagement\ClinicInvoice;
use Livewire\Component;

class Row extends Component { public ClinicInvoice $item; public function render() { return view('livewire.admin.clinic-management.clinic-invoices.row'); } }