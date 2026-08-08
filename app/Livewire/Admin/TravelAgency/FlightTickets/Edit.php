<?php

namespace App\Livewire\Admin\TravelAgency\FlightTickets;

use App\Models\TravelAgency\FlightTicket;
use App\Domain\TravelAgency\FlightTicket\DTOs\FlightTicketDTO;
use App\Domain\TravelAgency\FlightTicket\Actions\UpdateFlightTicketAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit FlightTicket')]
class Edit extends Component
{
        use WithPagination;
 public FlightTicket $item;
    public $client_id = '';
    public $flight_number = '';
    public $departure_date = '';
    public $price = '';
 
    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }
 
    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\TravelAgency\Client::find($value);
        if (!$related) return;
    }
 
    protected function getclientsList() {
        return \App\Models\TravelAgency\Client::pluck('name', 'id')->toArray();
    }

    public function mount(FlightTicket $flightTicket) { $this->item = $flightTicket; $this->fill($flightTicket->toArray()); $this->departure_date = $flightTicket->departure_date?->format('Y-m-d\TH:i'); }
    public function render() {
        abort_if_cannot('edit_flight_tickets');
        return view('livewire.admin.travel-agency.flight-tickets.edit', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateFlightTicketAction $action) { $this->validate();  $dto = FlightTicketDTO::fromArray([
            'client_id' => $this->client_id,
            'flight_number' => $this->flight_number,
            'departure_date' => $this->departure_date,
            'price' => $this->price,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('travel-agency/flight-tickets.updated')); return to_route('admin.travel-agency.flight-tickets.index'); }
    protected function rules(): array { return FlightTicket::rules($this->item->id); }
}