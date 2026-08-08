<?php

namespace App\Livewire\Admin\AutoRepairManagement\ExpenseTrackings;

use App\Models\AutoRepairManagement\ExpenseTracking;
use App\Domain\AutoRepairManagement\ExpenseTracking\DTOs\ExpenseTrackingDTO;
use App\Domain\AutoRepairManagement\ExpenseTracking\Actions\UpdateExpenseTrackingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit ExpenseTracking')]
class Edit extends Component
{
        use WithPagination;
 public ExpenseTracking $item;
    public $description = '';
    public $amount = '';
    public $date = '';
   
    public function mount(ExpenseTracking $expenseTracking) { $this->item = $expenseTracking; $this->fill($expenseTracking->toArray()); $this->date = $expenseTracking->date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_expense_trackings');
        return view('livewire.admin.auto-repair-management.expense-trackings.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateExpenseTrackingAction $action) { $this->validate();  $dto = ExpenseTrackingDTO::fromArray([
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/expense-trackings.updated')); return to_route('admin.auto-repair-management.expense-trackings.index'); }
    protected function rules(): array { return ExpenseTracking::rules($this->item->id); }
}