<?php

namespace App\Livewire\Admin\TravelAgency\TourBookings;

use App\Models\TravelAgency\TourBooking;
use App\Domain\TravelAgency\TourBooking\Queries\TourBookingListQuery;
use App\Domain\TravelAgency\TourBooking\Actions\DeleteTourBookingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('TourBookings')]
class TourBookings extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $client_id = '';
    #[Url(history: true)] public $tour_package_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'client_id', 'tour_package_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_tour_bookings');
        $query = (new TourBookingListQuery())->handle(['search' => $this->search,             'client_id' => $this->client_id,
            'tour_package_id' => $this->tour_package_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.travel-agency.tour-bookings.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => TourBooking::sortable(),
            'clients' => \App\Models\TravelAgency\Client::pluck('name', 'id')->toArray(),
            'tourPackages' => \App\Models\TravelAgency\TourPackage::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, TourBooking::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteTourBooking($id, DeleteTourBookingAction $action) 
    {
        abort_if_cannot('delete_tour_bookings');
        $item = TourBooking::find($id);
        if (!$item) { $this->dispatch('toast', message: __('travel-agency/tour-bookings.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('travel-agency/tour-bookings.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('travel-agency/tour-bookings.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('travel-agency/tour-bookings.delete_error'), type: 'error'); }
    }
}