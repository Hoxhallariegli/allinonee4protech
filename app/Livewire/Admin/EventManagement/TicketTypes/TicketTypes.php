<?php

namespace App\Livewire\Admin\EventManagement\TicketTypes;

use App\Models\EventManagement\TicketType;
use App\Domain\EventManagement\TicketType\Queries\TicketTypeListQuery;
use App\Domain\EventManagement\TicketType\Actions\DeleteTicketTypeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('TicketTypes')]
class TicketTypes extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $event_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'event_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_ticket_types');
        $query = (new TicketTypeListQuery())->handle(['search' => $this->search,             'event_id' => $this->event_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.event-management.ticket-types.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => TicketType::sortable(),
            'events' => \App\Models\EventManagement\Event::pluck('title', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, TicketType::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteTicketType($id, DeleteTicketTypeAction $action) 
    {
        abort_if_cannot('delete_ticket_types');
        $item = TicketType::find($id);
        if (!$item) { $this->dispatch('toast', message: __('event-management/ticket-types.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('event-management/ticket-types.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('event-management/ticket-types.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('event-management/ticket-types.delete_error'), type: 'error'); }
    }
}