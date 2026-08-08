<?php

namespace App\Domain\HotelManagement\HotelRoom\Queries;

use App\Models\HotelManagement\HotelRoom;
use Illuminate\Database\Eloquent\Builder;

class HotelRoomListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = HotelRoom::query()->with(['roomType']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('room_number', 'like', '%' . $params['search'] . '%');
                $query->orWhere('photo', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['room_type_id']) && $params['room_type_id']) $query->where('room_type_id', $params['room_type_id']);
        $sortField = in_array($sortField, HotelRoom::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}