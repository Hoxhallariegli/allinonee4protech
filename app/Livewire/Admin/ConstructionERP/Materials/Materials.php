<?php

namespace App\Livewire\Admin\ConstructionERP\Materials;

use App\Models\ConstructionERP\Material;
use App\Domain\ConstructionERP\Material\Queries\MaterialListQuery;
use App\Domain\ConstructionERP\Material\Actions\DeleteMaterialAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Materials')]
class Materials extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_materials');
        $query = (new MaterialListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.construction-e-r-p.materials.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Material::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Material::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteMaterial($id, DeleteMaterialAction $action) 
    {
        abort_if_cannot('delete_materials');
        $item = Material::find($id);
        if (!$item) { $this->dispatch('toast', message: __('construction-e-r-p/materials.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('construction-e-r-p/materials.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('construction-e-r-p/materials.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('construction-e-r-p/materials.delete_error'), type: 'error'); }
    }
}