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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.travel-agency.flight-tickets.quick-create', [
            'clients' => $this->getclientsList(),
        ]); }

    public function store(CreateFlightTicketAction $action)
    {
        $this->validate();
        $dto = FlightTicketDTO::fromArray([
            'client_id' => $this->client_id,
            'flight_number' => $this->flight_number,
            'departure_date' => $this->departure_date,
            'price' => $this->price,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('flight-ticket-created', id: $item->id);
        $this->js("Livewire.dispatch('flight-ticket-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('travel-agency/flight-tickets.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['client_id', 'flight_number', 'departure_date', 'price']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return FlightTicket::rules(); }
}