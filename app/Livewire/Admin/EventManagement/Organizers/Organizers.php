<?php

namespace App\Livewire\Admin\EventManagement\Organizers;

use App\Models\EventManagement\Organizer;
use App\Domain\EventManagement\Organizer\Queries\OrganizerListQuery;
use App\Domain\EventManagement\Organizer\Actions\DeleteOrganizerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Organizers')]
class Organizers extends Component
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
        abort_if_cannot('view_organizers');
        $query = (new OrganizerListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.event-management.organizers.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Organizer::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Organizer::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteOrganizer($id, DeleteOrganizerAction $action) 
    {
        abort_if_cannot('delete_organizers');
        $item = Organizer::find($id);
        if (!$item) { $this->dispatch('toast', message: __('event-management/organizers.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('event-management/organizers.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('event-management/organizers.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('event-management/organizers.delete_error'), type: 'error'); }
    }
}