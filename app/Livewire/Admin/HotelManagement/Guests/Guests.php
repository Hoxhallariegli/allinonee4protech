<?php

namespace App\Livewire\Admin\HotelManagement\Guests;

use App\Models\HotelManagement\Guest;
use App\Domain\HotelManagement\Guest\Queries\GuestListQuery;
use App\Domain\HotelManagement\Guest\Actions\DeleteGuestAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Guests')]
class Guests extends Component
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
        abort_if_cannot('view_guests');
        $query = (new GuestListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.hotel-management.guests.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Guest::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Guest::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteGuest($id, DeleteGuestAction $action) 
    {
        abort_if_cannot('delete_guests');
        $item = Guest::find($id);
        if (!$item) { $this->dispatch('toast', message: __('hotel-management/guests.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('hotel-management/guests.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('hotel-management/guests.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('hotel-management/guests.delete_error'), type: 'error'); }
    }
}