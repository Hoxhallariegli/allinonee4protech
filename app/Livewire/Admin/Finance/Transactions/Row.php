<?php

namespace App\Livewire\Admin\Finance\Transactions;

use App\Models\Finance\Transaction;
use Livewire\Component;

class Row extends Component { public Transaction $item; public function render() { return view('livewire.admin.finance.transactions.row'); } }