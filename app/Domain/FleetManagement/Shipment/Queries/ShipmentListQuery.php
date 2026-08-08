<?php

namespace App\Domain\FleetManagement\Shipment\Queries;

use App\Models\FleetManagement\Shipment;
use Illuminate\Database\Eloquent\Builder;

class ShipmentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Shipment::query()->with(['vehicle', 'driver']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('origin', 'like', '%' . $params['search'] . '%');
                $query->orWhere('destination', 'like', '%' . $params['search'] . '%');
                $query->orWhere('status', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['vehicle_id']) && $params['vehicle_id']) $query->where('vehicle_id', $params['vehicle_id']);
        if (isset($params['driver_id']) && $params['driver_id']) $query->where('driver_id', $params['driver_id']);
        $sortField = in_array($sortField, Shipment::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}