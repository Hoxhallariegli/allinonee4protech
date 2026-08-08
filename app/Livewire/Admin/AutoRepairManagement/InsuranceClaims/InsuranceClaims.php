<?php

namespace App\Livewire\Admin\AutoRepairManagement\InsuranceClaims;

use App\Models\AutoRepairManagement\InsuranceClaim;
use App\Domain\AutoRepairManagement\InsuranceClaim\Queries\InsuranceClaimListQuery;
use App\Domain\AutoRepairManagement\InsuranceClaim\Actions\DeleteInsuranceClaimAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('InsuranceClaims')]
class InsuranceClaims extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $vehicle_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'vehicle_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_insurance_claims');
        $query = (new InsuranceClaimListQuery())->handle(['search' => $this->search,             'vehicle_id' => $this->vehicle_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.insurance-claims.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => InsuranceClaim::sortable(),
            'vehicles' => \App\Models\AutoRepairManagement\Vehicle::pluck('license_plate', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, InsuranceClaim::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteInsuranceClaim($id, DeleteInsuranceClaimAction $action) 
    {
        abort_if_cannot('delete_insurance_claims');
        $item = InsuranceClaim::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/insurance-claims.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/insurance-claims.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/insurance-claims.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/insurance-claims.delete_error'), type: 'error'); }
    }
}