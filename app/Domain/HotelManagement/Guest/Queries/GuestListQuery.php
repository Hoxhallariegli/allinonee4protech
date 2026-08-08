<?php

namespace App\Domain\HotelManagement\Guest\Queries;

use App\Models\HotelManagement\Guest;
use Illuminate\Database\Eloquent\Builder;

class GuestListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Guest::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('email', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Guest::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}