<?php

namespace App\Domain\FleetManagement\Vehicle\Queries;

use App\Models\FleetManagement\Vehicle;
use Illuminate\Database\Eloquent\Builder;

class VehicleListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Vehicle::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('make', 'like', '%' . $params['search'] . '%');
                $query->orWhere('model', 'like', '%' . $params['search'] . '%');
                $query->orWhere('license_plate', 'like', '%' . $params['search'] . '%');
                $query->orWhere('photo', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Vehicle::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}