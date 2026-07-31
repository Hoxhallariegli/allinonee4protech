<?php

namespace App\Domain\AutoRepairManagement\Inventory\Queries;

use App\Models\AutoRepairManagement\Inventory;
use Illuminate\Database\Eloquent\Builder;

class InventoryListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Inventory::query()->with(['part']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['part_id']) && $params['part_id']) $query->where('part_id', $params['part_id']);
        $sortField = in_array($sortField, Inventory::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}