<?php

namespace App\Livewire\Admin\AutoRepairManagement\ExpenseTrackings;

use App\Models\AutoRepairManagement\ExpenseTracking;
use App\Domain\AutoRepairManagement\ExpenseTracking\DTOs\ExpenseTrackingDTO;
use App\Domain\AutoRepairManagement\ExpenseTracking\Actions\CreateExpenseTrackingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add ExpenseTracking')]
class Create extends Component
{
        use WithPagination;
     public $description = '';
    public $amount = '';
    public $date = '';
   
    public function render() {
        abort_if_cannot('add_expense_trackings');
        return view('livewire.admin.auto-repair-management.expense-trackings.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateExpenseTrackingAction $action) { $this->validate();  $dto = ExpenseTrackingDTO::fromArray([
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/expense-trackings.created')); return to_route('admin.auto-repair-management.expense-trackings.index'); }
    protected function rules(): array { return ExpenseTracking::rules(); }
}