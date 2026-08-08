<?php

namespace App\Livewire\Admin\HumanResources\Payrolls;

use App\Models\HumanResources\Payroll;
use App\Domain\HumanResources\Payroll\DTOs\PayrollDTO;
use App\Domain\HumanResources\Payroll\Actions\UpdatePayrollAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Payroll')]
class Edit extends Component
{
        use WithPagination;
 public Payroll $item;
    public $employee_id = '';
    public $month = '';
    public $amount = '';
    public $is_paid = '';
 
    #[On('employee-created')] 
    public function refreshEmployees($id) { $this->employee_id = $id; $this->updatedEmployeeId($id); }
 
    public function updatedEmployeeId($value)
    {
        if (!$value) return;
        $related = \App\Models\HumanResources\Employee::find($value);
        if (!$related) return;
    }
 
    protected function getemployeesList() {
        return \App\Models\HumanResources\Employee::pluck('name', 'id')->toArray();
    }

    public function mount(Payroll $payroll) { $this->item = $payroll; $this->fill($payroll->toArray());  }
    public function render() {
        abort_if_cannot('edit_payrolls');
        return view('livewire.admin.human-resources.payrolls.edit', [
            'employees' => $this->getemployeesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdatePayrollAction $action) { $this->validate();  $dto = PayrollDTO::fromArray([
            'employee_id' => $this->employee_id,
            'month' => $this->month,
            'amount' => $this->amount,
            'is_paid' => $this->is_paid,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('human-resources/payrolls.updated')); return to_route('admin.human-resources.payrolls.index'); }
    protected function rules(): array { return Payroll::rules($this->item->id); }
}