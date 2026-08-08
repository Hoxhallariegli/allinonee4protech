<?php

namespace App\Livewire\Admin\HotelManagement\HotelRooms;

use App\Models\HotelManagement\HotelRoom;
use App\Domain\HotelManagement\HotelRoom\Queries\HotelRoomListQuery;
use App\Domain\HotelManagement\HotelRoom\Actions\DeleteHotelRoomAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('HotelRooms')]
class HotelRooms extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $room_type_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'room_type_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_hotel_rooms');
        $query = (new HotelRoomListQuery())->handle(['search' => $this->search,             'room_type_id' => $this->room_type_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.hotel-management.hotel-rooms.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => HotelRoom::sortable(),
            'roomTypes' => \App\Models\HotelManagement\RoomType::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, HotelRoom::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteHotelRoom($id, DeleteHotelRoomAction $action) 
    {
        abort_if_cannot('delete_hotel_rooms');
        $item = HotelRoom::find($id);
        if (!$item) { $this->dispatch('toast', message: __('hotel-management/hotel-rooms.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('hotel-management/hotel-rooms.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('hotel-management/hotel-rooms.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('hotel-management/hotel-rooms.delete_error'), type: 'error'); }
    }
}