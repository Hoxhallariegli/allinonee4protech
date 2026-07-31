<?php

namespace App\Livewire\Admin\AutoRepairManagement\EstimateItems;

use App\Models\AutoRepairManagement\EstimateItem;
use App\Domain\AutoRepairManagement\EstimateItem\Queries\EstimateItemListQuery;
use App\Domain\AutoRepairManagement\EstimateItem\Actions\DeleteEstimateItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('EstimateItems')]
class EstimateItems extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $estimate_id = '';
    #[Url(history: true)] public $service_id = '';
    #[Url(history: true)] public $part_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'estimate_id', 'service_id', 'part_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_estimate_items');
        $query = (new EstimateItemListQuery())->handle(['search' => $this->search,             'estimate_id' => $this->estimate_id,
            'service_id' => $this->service_id,
            'part_id' => $this->part_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.auto-repair-management.estimate-items.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => EstimateItem::sortable(),
            'estimates' => \App\Models\AutoRepairManagement\Estimate::pluck('id', 'id')->toArray(),
            'services' => \App\Models\AutoRepairManagement\Service::pluck('name', 'id')->toArray(),
            'parts' => \App\Models\AutoRepairManagement\Part::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, EstimateItem::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteEstimateItem($id, DeleteEstimateItemAction $action) 
    {
        abort_if_cannot('delete_estimate_items');
        $item = EstimateItem::find($id);
        if (!$item) { $this->dispatch('toast', message: __('auto-repair-management/estimate-items.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('auto-repair-management/estimate-items.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('auto-repair-management/estimate-items.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('auto-repair-management/estimate-items.delete_error'), type: 'error'); }
    }
}