<?php

namespace App\Domain\VehicleModel\Queries;

use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Builder;

class VehicleModelListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = VehicleModel::query()->with(['brand']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['brand_id']) && $params['brand_id']) $query->where('brand_id', $params['brand_id']);
        $sortField = in_array($sortField, VehicleModel::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}