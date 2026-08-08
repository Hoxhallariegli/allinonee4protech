<?php

namespace App\Livewire\Admin\AutoRepairManagement\CustomerAddresses;

use App\Models\AutoRepairManagement\CustomerAddress;
use App\Domain\AutoRepairManagement\CustomerAddress\Queries\CustomerAddressListQuery;
use App\Domain\AutoRepairManagement\CustomerAddress\Actions\DeleteCustomerAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('CustomerAddresses')]
class CustomerAddresses extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $customer_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'customer_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_customer_addresses');
        $query = (new CustomerAddressListQuery())->handle(['search' => $this->search,             'customer_id' => $this->customer_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.customer-addresses.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => CustomerAddress::sortable(),
            'customers' => \App\Models\AutoRepairManagement\Customer::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, CustomerAddress::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteCustomerAddress($id, DeleteCustomerAddressAction $action) 
    {
        abort_if_cannot('delete_customer_addresses');
        $item = CustomerAddress::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/customer-addresses.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/customer-addresses.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/customer-addresses.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/customer-addresses.delete_error'), type: 'error'); }
    }
}