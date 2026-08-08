<?php

namespace App\Livewire\Admin\TravelAgency\TourBookings;

use App\Models\TravelAgency\TourBooking;
use App\Domain\TravelAgency\TourBooking\DTOs\TourBookingDTO;
use App\Domain\TravelAgency\TourBooking\Actions\CreateTourBookingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add TourBooking')]
class Create extends Component
{
        use WithPagination;
     public $client_id = '';
    public $tour_package_id = '';
    public $booking_date = '';
 
    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }

    #[On('tour-package-created')] 
    public function refreshTourPackages($id) { $this->tour_package_id = $id; $this->updatedTourPackageId($id); }
 
    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\TravelAgency\Client::find($value);
        if (!$related) return;
    }

    public function updatedTourPackageId($value)
    {
        if (!$value) return;
        $related = \App\Models\TravelAgency\TourPackage::find($value);
        if (!$related) return;
    }
 
    protected function getclientsList() {
        return \App\Models\TravelAgency\Client::pluck('name', 'id')->toArray();
    }

    protected function gettourPackagesList() {
        return \App\Models\TravelAgency\TourPackage::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_tour_bookings');
        return view('livewire.admin.travel-agency.tour-bookings.create', [
            'clients' => $this->getclientsList(),
            'tourPackages' => $this->gettourPackagesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateTourBookingAction $action) { $this->validate();  $dto = TourBookingDTO::fromArray([
            'client_id' => $this->client_id,
            'tour_package_id' => $this->tour_package_id,
            'booking_date' => $this->booking_date,
        ]); $action->execute($dto); session()->flash('success', __('travel-agency/tour-bookings.created')); return to_route('admin.travel-agency.tour-bookings.index'); }
    protected function rules(): array { return TourBooking::rules(); }
}