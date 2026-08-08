<?php

namespace App\Domain\HotelManagement\Housekeeping\Queries;

use App\Models\HotelManagement\Housekeeping;
use Illuminate\Database\Eloquent\Builder;

class HousekeepingListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Housekeeping::query()->with(['room']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('task', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['room_id']) && $params['room_id']) $query->where('room_id', $params['room_id']);
        $sortField = in_array($sortField, Housekeeping::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}