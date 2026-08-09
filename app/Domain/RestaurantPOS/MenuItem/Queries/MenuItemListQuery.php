<?php

namespace App\Domain\RestaurantPOS\MenuItem\Queries;

use App\Models\RestaurantPOS\MenuItem;
use Illuminate\Database\Eloquent\Builder;

class MenuItemListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = MenuItem::query()->with('category');
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhereHas('category', function($q) use ($params) {
                    $q->where('name', 'like', '%' . $params['search'] . '%');
                });
            });
        }

        $sortField = in_array($sortField, MenuItem::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}
