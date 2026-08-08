<?php

namespace App\Domain\FacilityManagement\Building\Queries;

use App\Models\FacilityManagement\Building;
use Illuminate\Database\Eloquent\Builder;

class BuildingListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Building::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('address', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Building::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}