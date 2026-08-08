<?php

namespace App\Domain\FacilityManagement\MaintenanceRequest\Queries;

use App\Models\FacilityManagement\MaintenanceRequest;
use Illuminate\Database\Eloquent\Builder;

class MaintenanceRequestListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = MaintenanceRequest::query()->with(['building', 'technician']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['building_id']) && $params['building_id']) $query->where('building_id', $params['building_id']);
        if (isset($params['technician_id']) && $params['technician_id']) $query->where('technician_id', $params['technician_id']);
        $sortField = in_array($sortField, MaintenanceRequest::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}