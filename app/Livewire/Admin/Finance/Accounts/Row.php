<?php

namespace App\Livewire\Admin\Finance\Accounts;

use App\Models\Finance\Account;
use Livewire\Component;

class Row extends Component { public Account $item; public function render() { return view('livewire.admin.finance.accounts.row'); } }