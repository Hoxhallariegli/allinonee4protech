<?php

namespace App\Livewire\Admin\TravelAgency\TourBookings;

use App\Models\TravelAgency\TourBooking;
use App\Domain\TravelAgency\TourBooking\DTOs\TourBookingDTO;
use App\Domain\TravelAgency\TourBooking\Actions\UpdateTourBookingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit TourBooking')]
class Edit extends Component
{
        use WithPagination;
 public TourBooking $item;
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

    public function mount(TourBooking $tourBooking) { $this->item = $tourBooking; $this->fill($tourBooking->toArray()); $this->booking_date = $tourBooking->booking_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_tour_bookings');
        return view('livewire.admin.travel-agency.tour-bookings.edit', [
            'clients' => $this->getclientsList(),
            'tourPackages' => $this->gettourPackagesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateTourBookingAction $action) { $this->validate();  $dto = TourBookingDTO::fromArray([
            'client_id' => $this->client_id,
            'tour_package_id' => $this->tour_package_id,
            'booking_date' => $this->booking_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('travel-agency/tour-bookings.updated')); return to_route('admin.travel-agency.tour-bookings.index'); }
    protected function rules(): array { return TourBooking::rules($this->item->id); }
}