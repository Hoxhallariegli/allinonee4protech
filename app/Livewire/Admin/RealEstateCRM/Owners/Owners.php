<?php

namespace App\Livewire\Admin\RealEstateCRM\Owners;

use App\Models\RealEstateCRM\Owner;
use App\Domain\RealEstateCRM\Owner\Queries\OwnerListQuery;
use App\Domain\RealEstateCRM\Owner\Actions\DeleteOwnerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Owners')]
class Owners extends Component
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
        abort_if_cannot('view_owners');
        $query = (new OwnerListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.real-estate-c-r-m.owners.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Owner::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Owner::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteOwner($id, DeleteOwnerAction $action) 
    {
        abort_if_cannot('delete_owners');
        $item = Owner::find($id);
        if (!$item) { $this->dispatch('toast', message: __('real-estate-c-r-m/owners.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('real-estate-c-r-m/owners.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/owners.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/owners.delete_error'), type: 'error'); }
    }
}