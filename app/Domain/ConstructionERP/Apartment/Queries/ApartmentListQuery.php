<?php

namespace App\Domain\ConstructionERP\Apartment\Queries;

use App\Models\ConstructionERP\Apartment;
use Illuminate\Database\Eloquent\Builder;

class ApartmentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Apartment::query()->with(['building']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('number', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['building_id']) && $params['building_id']) $query->where('building_id', $params['building_id']);
        $sortField = in_array($sortField, Apartment::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}