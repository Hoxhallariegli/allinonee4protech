<?php

namespace App\Livewire\Admin\AutoRepairManagement\Estimates;

use App\Models\AutoRepairManagement\Estimate;
use App\Domain\AutoRepairManagement\Estimate\Queries\EstimateListQuery;
use App\Domain\AutoRepairManagement\Estimate\Actions\DeleteEstimateAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Estimates')]
class Estimates extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $job_card_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'job_card_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_estimates');
        $query = (new EstimateListQuery())->handle(['search' => $this->search,             'job_card_id' => $this->job_card_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.estimates.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Estimate::sortable(),
            'jobCards' => \App\Models\AutoRepairManagement\JobCard::pluck('id', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Estimate::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteEstimate($id, DeleteEstimateAction $action) 
    {
        abort_if_cannot('delete_estimates');
        $item = Estimate::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/estimates.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/estimates.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/estimates.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/estimates.delete_error'), type: 'error'); }
    }
}