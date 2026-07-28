<?php

namespace App\Domain\VehicleDocument\Queries;

use App\Models\VehicleDocument;
use Illuminate\Database\Eloquent\Builder;

class VehicleDocumentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = VehicleDocument::query()->with(['vehicle']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('type', 'like', '%' . $params['search'] . '%');
                $query->orWhere('document', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['vehicle_id']) && $params['vehicle_id']) $query->where('vehicle_id', $params['vehicle_id']);
        $sortField = in_array($sortField, VehicleDocument::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}