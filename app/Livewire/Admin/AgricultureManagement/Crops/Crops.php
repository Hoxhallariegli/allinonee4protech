<?php

namespace App\Livewire\Admin\AgricultureManagement\Crops;

use App\Models\AgricultureManagement\Crop;
use App\Domain\AgricultureManagement\Crop\Queries\CropListQuery;
use App\Domain\AgricultureManagement\Crop\Actions\DeleteCropAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Crops')]
class Crops extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $field_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'field_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_crops');
        $query = (new CropListQuery())->handle(['search' => $this->search,             'field_id' => $this->field_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.agriculture-management.crops.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Crop::sortable(),
            'fields' => \App\Models\AgricultureManagement\Field::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Crop::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteCrop($id, DeleteCropAction $action) 
    {
        abort_if_cannot('delete_crops');
        $item = Crop::find($id);
        if (!$item) { $this->dispatch('toast', message: __('agriculture-management/crops.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('agriculture-management/crops.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('agriculture-management/crops.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('agriculture-management/crops.delete_error'), type: 'error'); }
    }
}