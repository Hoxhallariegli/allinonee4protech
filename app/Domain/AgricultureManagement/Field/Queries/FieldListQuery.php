<?php

namespace App\Domain\AgricultureManagement\Field\Queries;

use App\Models\AgricultureManagement\Field;
use Illuminate\Database\Eloquent\Builder;

class FieldListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Field::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('soil_type', 'like', '%' . $params['search'] . '%');
                $query->orWhere('location_photo', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Field::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}