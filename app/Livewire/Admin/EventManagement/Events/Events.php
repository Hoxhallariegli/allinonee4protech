<?php

namespace App\Livewire\Admin\EventManagement\Events;

use App\Models\EventManagement\Event;
use App\Domain\EventManagement\Event\Queries\EventListQuery;
use App\Domain\EventManagement\Event\Actions\DeleteEventAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Events')]
class Events extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $organizer_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'organizer_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_events');
        $query = (new EventListQuery())->handle(['search' => $this->search,             'organizer_id' => $this->organizer_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.event-management.events.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Event::sortable(),
            'organizers' => \App\Models\EventManagement\Organizer::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Event::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteEvent($id, DeleteEventAction $action) 
    {
        abort_if_cannot('delete_events');
        $item = Event::find($id);
        if (!$item) { $this->dispatch('toast', message: __('event-management/events.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('event-management/events.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('event-management/events.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('event-management/events.delete_error'), type: 'error'); }
    }
}