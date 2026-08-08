<?php

namespace App\Livewire\Admin\ECommerce\Customers;

use App\Models\ECommerce\Customer;
use App\Domain\ECommerce\Customer\Queries\CustomerListQuery;
use App\Domain\ECommerce\Customer\Actions\DeleteCustomerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Customers')]
class Customers extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_customers');
        $query = (new CustomerListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.e--commerce.customers.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Customer::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Customer::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteCustomer($id, DeleteCustomerAction $action) 
    {
        abort_if_cannot('delete_customers');
        $item = Customer::find($id);
        if (!$item) { $this->dispatch('toast', message: __('e--commerce/customers.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('e--commerce/customers.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('e--commerce/customers.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('e--commerce/customers.delete_error'), type: 'error'); }
    }
}