<?php

namespace App\Livewire\Admin\HotelManagement\Housekeepings;

use App\Models\HotelManagement\Housekeeping;
use App\Domain\HotelManagement\Housekeeping\Queries\HousekeepingListQuery;
use App\Domain\HotelManagement\Housekeeping\Actions\DeleteHousekeepingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Housekeepings')]
class Housekeepings extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $room_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'room_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_housekeepings');
        $query = (new HousekeepingListQuery())->handle(['search' => $this->search,             'room_id' => $this->room_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.hotel-management.housekeepings.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Housekeeping::sortable(),
            'rooms' => \App\Models\HotelManagement\HotelRoom::pluck('room_number', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Housekeeping::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteHousekeeping($id, DeleteHousekeepingAction $action) 
    {
        abort_if_cannot('delete_housekeepings');
        $item = Housekeeping::find($id);
        if (!$item) { $this->dispatch('toast', message: __('hotel-management/housekeepings.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('hotel-management/housekeepings.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('hotel-management/housekeepings.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('hotel-management/housekeepings.delete_error'), type: 'error'); }
    }
}