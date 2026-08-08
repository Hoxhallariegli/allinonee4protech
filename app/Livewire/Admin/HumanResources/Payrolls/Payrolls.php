<?php

namespace App\Livewire\Admin\HumanResources\Payrolls;

use App\Models\HumanResources\Payroll;
use App\Domain\HumanResources\Payroll\Queries\PayrollListQuery;
use App\Domain\HumanResources\Payroll\Actions\DeletePayrollAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Payrolls')]
class Payrolls extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $employee_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'employee_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_payrolls');
        $query = (new PayrollListQuery())->handle(['search' => $this->search,             'employee_id' => $this->employee_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.human-resources.payrolls.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Payroll::sortable(),
            'employees' => \App\Models\HumanResources\Employee::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Payroll::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePayroll($id, DeletePayrollAction $action) 
    {
        abort_if_cannot('delete_payrolls');
        $item = Payroll::find($id);
        if (!$item) { $this->dispatch('toast', message: __('human-resources/payrolls.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('human-resources/payrolls.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('human-resources/payrolls.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('human-resources/payrolls.delete_error'), type: 'error'); }
    }
}