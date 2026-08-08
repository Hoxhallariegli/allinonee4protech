<?php

namespace App\Domain\FleetManagement\FuelLog\Queries;

use App\Models\FleetManagement\FuelLog;
use Illuminate\Database\Eloquent\Builder;

class FuelLogListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = FuelLog::query()->with(['vehicle']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['vehicle_id']) && $params['vehicle_id']) $query->where('vehicle_id', $params['vehicle_id']);
        $sortField = in_array($sortField, FuelLog::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}