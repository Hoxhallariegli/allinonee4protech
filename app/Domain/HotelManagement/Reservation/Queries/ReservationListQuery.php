<?php

namespace App\Domain\HotelManagement\Reservation\Queries;

use App\Models\HotelManagement\Reservation;
use Illuminate\Database\Eloquent\Builder;

class ReservationListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Reservation::query()->with(['guest', 'room']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['guest_id']) && $params['guest_id']) $query->where('guest_id', $params['guest_id']);
        if (isset($params['room_id']) && $params['room_id']) $query->where('room_id', $params['room_id']);
        $sortField = in_array($sortField, Reservation::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}