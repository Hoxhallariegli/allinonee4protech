<?php

namespace App\Livewire\Admin\AgricultureManagement\Fields;

use App\Models\AgricultureManagement\Field;
use App\Domain\AgricultureManagement\Field\Queries\FieldListQuery;
use App\Domain\AgricultureManagement\Field\Actions\DeleteFieldAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Fields')]
class Fields extends Component
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
        abort_if_cannot('view_fields');
        $query = (new FieldListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.agriculture-management.fields.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Field::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Field::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteField($id, DeleteFieldAction $action) 
    {
        abort_if_cannot('delete_fields');
        $item = Field::find($id);
        if (!$item) { $this->dispatch('toast', message: __('agriculture-management/fields.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('agriculture-management/fields.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('agriculture-management/fields.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('agriculture-management/fields.delete_error'), type: 'error'); }
    }
}