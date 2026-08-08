<?php

namespace App\Domain\TravelAgency\FlightTicket\Queries;

use App\Models\TravelAgency\FlightTicket;
use Illuminate\Database\Eloquent\Builder;

class FlightTicketListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = FlightTicket::query()->with(['client']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('flight_number', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['client_id']) && $params['client_id']) $query->where('client_id', $params['client_id']);
        $sortField = in_array($sortField, FlightTicket::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}