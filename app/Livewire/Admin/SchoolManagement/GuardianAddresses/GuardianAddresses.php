<?php

namespace App\Livewire\Admin\SchoolManagement\GuardianAddresses;

use App\Models\SchoolManagement\GuardianAddress;
use App\Domain\SchoolManagement\GuardianAddress\Queries\GuardianAddressListQuery;
use App\Domain\SchoolManagement\GuardianAddress\Actions\DeleteGuardianAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('GuardianAddresses')]
class GuardianAddresses extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $guardian_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'guardian_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_guardian_addresses');
        $query = (new GuardianAddressListQuery())->handle(['search' => $this->search,             'guardian_id' => $this->guardian_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.school-management.guardian-addresses.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => GuardianAddress::sortable(),
            'guardians' => \App\Models\SchoolManagement\Guardian::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, GuardianAddress::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteGuardianAddress($id, DeleteGuardianAddressAction $action) 
    {
        abort_if_cannot('delete_guardian_addresses');
        $item = GuardianAddress::find($id);
        if (!$item) { $this->dispatch('toast', message: __('school-management/guardian-addresses.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('school-management/guardian-addresses.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('school-management/guardian-addresses.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('school-management/guardian-addresses.delete_error'), type: 'error'); }
    }
}