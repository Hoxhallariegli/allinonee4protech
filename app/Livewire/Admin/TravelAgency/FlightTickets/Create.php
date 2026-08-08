<?php

namespace App\Livewire\Admin\TravelAgency\FlightTickets;

use App\Models\TravelAgency\FlightTicket;
use App\Domain\TravelAgency\FlightTicket\DTOs\FlightTicketDTO;
use App\Domain\TravelAgency\FlightTicket\Actions\CreateFlightTicketAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add FlightTicket')]
class Create extends Component
{
        use WithPagination;
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

    public function render() {
        abort_if_cannot('add_flight_tickets');
        return view('livewire.admin.travel-agency.flight-tickets.create', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateFlightTicketAction $action) { $this->validate();  $dto = FlightTicketDTO::fromArray([
            'client_id' => $this->client_id,
            'flight_number' => $this->flight_number,
            'departure_date' => $this->departure_date,
            'price' => $this->price,
        ]); $action->execute($dto); session()->flash('success', __('travel-agency/flight-tickets.created')); return to_route('admin.travel-agency.flight-tickets.index'); }
    protected function rules(): array { return FlightTicket::rules(); }
}