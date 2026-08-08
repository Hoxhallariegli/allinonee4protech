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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.travel-agency.tour-bookings.quick-create', [
            'clients' => $this->getclientsList(),
            'tourPackages' => $this->gettourPackagesList(),
        ]); }

    public function store(CreateTourBookingAction $action)
    {
        $this->validate();
        $dto = TourBookingDTO::fromArray([
            'client_id' => $this->client_id,
            'tour_package_id' => $this->tour_package_id,
            'booking_date' => $this->booking_date,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('tour-booking-created', id: $item->id);
        $this->js("Livewire.dispatch('tour-booking-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('travel-agency/tour-bookings.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['client_id', 'tour_package_id', 'booking_date']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return TourBooking::rules(); }
}