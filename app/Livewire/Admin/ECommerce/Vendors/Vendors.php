<?php

namespace App\Livewire\Admin\ECommerce\Vendors;

use App\Models\ECommerce\Vendor;
use App\Domain\ECommerce\Vendor\Queries\VendorListQuery;
use App\Domain\ECommerce\Vendor\Actions\DeleteVendorAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Vendors')]
class Vendors extends Component
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
        abort_if_cannot('view_vendors');
        $query = (new VendorListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.e--commerce.vendors.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Vendor::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Vendor::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteVendor($id, DeleteVendorAction $action) 
    {
        abort_if_cannot('delete_vendors');
        $item = Vendor::find($id);
        if (!$item) { $this->dispatch('toast', message: __('e--commerce/vendors.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('e--commerce/vendors.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('e--commerce/vendors.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('e--commerce/vendors.delete_error'), type: 'error'); }
    }
}