<?php

namespace App\Livewire\Admin\HotelManagement\Reservations;

use App\Models\HotelManagement\Reservation;
use App\Domain\HotelManagement\Reservation\Queries\ReservationListQuery;
use App\Domain\HotelManagement\Reservation\Actions\DeleteReservationAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Reservations')]
class Reservations extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $guest_id = '';
    #[Url(history: true)] public $room_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'guest_id', 'room_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_reservations');
        $query = (new ReservationListQuery())->handle(['search' => $this->search,             'guest_id' => $this->guest_id,
            'room_id' => $this->room_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.hotel-management.reservations.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Reservation::sortable(),
            'guests' => \App\Models\HotelManagement\Guest::pluck('name', 'id')->toArray(),
            'rooms' => \App\Models\HotelManagement\HotelRoom::pluck('room_number', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Reservation::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteReservation($id, DeleteReservationAction $action) 
    {
        abort_if_cannot('delete_reservations');
        $item = Reservation::find($id);
        if (!$item) { $this->dispatch('toast', message: __('hotel-management/reservations.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('hotel-management/reservations.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('hotel-management/reservations.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('hotel-management/reservations.delete_error'), type: 'error'); }
    }
}