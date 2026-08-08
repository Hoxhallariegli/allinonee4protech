<?php

namespace App\Livewire\Admin\EventManagement\Attendees;

use App\Models\EventManagement\Attendee;
use App\Domain\EventManagement\Attendee\Queries\AttendeeListQuery;
use App\Domain\EventManagement\Attendee\Actions\DeleteAttendeeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Attendees')]
class Attendees extends Component
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
        abort_if_cannot('view_attendees');
        $query = (new AttendeeListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.event-management.attendees.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Attendee::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Attendee::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteAttendee($id, DeleteAttendeeAction $action) 
    {
        abort_if_cannot('delete_attendees');
        $item = Attendee::find($id);
        if (!$item) { $this->dispatch('toast', message: __('event-management/attendees.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('event-management/attendees.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('event-management/attendees.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('event-management/attendees.delete_error'), type: 'error'); }
    }
}