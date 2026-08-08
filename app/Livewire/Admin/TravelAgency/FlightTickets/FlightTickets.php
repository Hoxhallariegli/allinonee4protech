<?php

namespace App\Livewire\Admin\TravelAgency\FlightTickets;

use App\Models\TravelAgency\FlightTicket;
use App\Domain\TravelAgency\FlightTicket\Queries\FlightTicketListQuery;
use App\Domain\TravelAgency\FlightTicket\Actions\DeleteFlightTicketAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('FlightTickets')]
class FlightTickets extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $client_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'client_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_flight_tickets');
        $query = (new FlightTicketListQuery())->handle(['search' => $this->search,             'client_id' => $this->client_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.travel-agency.flight-tickets.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => FlightTicket::sortable(),
            'clients' => \App\Models\TravelAgency\Client::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, FlightTicket::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteFlightTicket($id, DeleteFlightTicketAction $action) 
    {
        abort_if_cannot('delete_flight_tickets');
        $item = FlightTicket::find($id);
        if (!$item) { $this->dispatch('toast', message: __('travel-agency/flight-tickets.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('travel-agency/flight-tickets.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('travel-agency/flight-tickets.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('travel-agency/flight-tickets.delete_error'), type: 'error'); }
    }
}