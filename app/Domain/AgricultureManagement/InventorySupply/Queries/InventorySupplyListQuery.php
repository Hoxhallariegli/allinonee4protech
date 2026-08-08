<?php

namespace App\Domain\AgricultureManagement\InventorySupply\Queries;

use App\Models\AgricultureManagement\InventorySupply;
use Illuminate\Database\Eloquent\Builder;

class InventorySupplyListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = InventorySupply::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('unit', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, InventorySupply::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}