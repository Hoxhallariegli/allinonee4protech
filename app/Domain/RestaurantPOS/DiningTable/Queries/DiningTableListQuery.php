<?php

namespace App\Domain\RestaurantPOS\DiningTable\Queries;

use App\Models\RestaurantPOS\DiningTable;
use Illuminate\Database\Eloquent\Builder;

class DiningTableListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = DiningTable::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('number', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, DiningTable::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}