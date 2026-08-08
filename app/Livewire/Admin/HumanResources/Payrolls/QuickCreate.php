<?php

namespace App\Livewire\Admin\HumanResources\Payrolls;

use App\Models\HumanResources\Payroll;
use App\Domain\HumanResources\Payroll\DTOs\PayrollDTO;
use App\Domain\HumanResources\Payroll\Actions\CreatePayrollAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.human-resources.payrolls.quick-create', [
            'employees' => $this->getemployeesList(),
        ]); }

    public function store(CreatePayrollAction $action)
    {
        $this->validate();
        $dto = PayrollDTO::fromArray([
            'employee_id' => $this->employee_id,
            'month' => $this->month,
            'amount' => $this->amount,
            'is_paid' => $this->is_paid,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('payroll-created', id: $item->id);
        $this->js("Livewire.dispatch('payroll-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('human-resources/payrolls.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['employee_id', 'month', 'amount', 'is_paid']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Payroll::rules(); }
}