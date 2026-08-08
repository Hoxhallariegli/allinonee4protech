<?php

namespace App\Livewire\Admin\HotelManagement\RoomTypes;

use App\Models\HotelManagement\RoomType;
use App\Domain\HotelManagement\RoomType\Queries\RoomTypeListQuery;
use App\Domain\HotelManagement\RoomType\Actions\DeleteRoomTypeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('RoomTypes')]
class RoomTypes extends Component
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
        abort_if_cannot('view_room_types');
        $query = (new RoomTypeListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.hotel-management.room-types.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => RoomType::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, RoomType::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteRoomType($id, DeleteRoomTypeAction $action) 
    {
        abort_if_cannot('delete_room_types');
        $item = RoomType::find($id);
        if (!$item) { $this->dispatch('toast', message: __('hotel-management/room-types.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('hotel-management/room-types.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('hotel-management/room-types.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('hotel-management/room-types.delete_error'), type: 'error'); }
    }
}