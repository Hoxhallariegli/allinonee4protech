<?php

namespace App\Livewire\Admin\RealEstateCRM\Properties;

use App\Models\RealEstateCRM\Property;
use App\Domain\RealEstateCRM\Property\Queries\PropertyListQuery;
use App\Domain\RealEstateCRM\Property\Actions\DeletePropertyAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Properties')]
class Properties extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $owner_id = '';
    #[Url(history: true)] public $agent_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'owner_id', 'agent_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_properties');
        $query = (new PropertyListQuery())->handle(['search' => $this->search,             'owner_id' => $this->owner_id,
            'agent_id' => $this->agent_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.real-estate-c-r-m.properties.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Property::sortable(),
            'owners' => \App\Models\RealEstateCRM\Owner::pluck('name', 'id')->toArray(),
            'agents' => \App\Models\RealEstateCRM\Agent::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Property::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteProperty($id, DeletePropertyAction $action) 
    {
        abort_if_cannot('delete_properties');
        $item = Property::find($id);
        if (!$item) { $this->dispatch('toast', message: __('real-estate-c-r-m/properties.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('real-estate-c-r-m/properties.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/properties.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('real-estate-c-r-m/properties.delete_error'), type: 'error'); }
    }
}