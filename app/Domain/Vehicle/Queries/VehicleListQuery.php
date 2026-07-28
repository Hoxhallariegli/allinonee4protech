<?php

namespace App\Domain\Vehicle\Queries;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;

class VehicleListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Vehicle::query()->with(['brand', 'model', 'customer']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('license_plate', 'like', '%' . $params['search'] . '%');
                $query->orWhere('vin', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['brand_id']) && $params['brand_id']) $query->where('brand_id', $params['brand_id']);
        if (isset($params['model_id']) && $params['model_id']) $query->where('model_id', $params['model_id']);
        if (isset($params['customer_id']) && $params['customer_id']) $query->where('customer_id', $params['customer_id']);
        $sortField = in_array($sortField, Vehicle::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}