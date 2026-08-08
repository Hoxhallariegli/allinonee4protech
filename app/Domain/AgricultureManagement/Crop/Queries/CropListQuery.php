<?php

namespace App\Domain\AgricultureManagement\Crop\Queries;

use App\Models\AgricultureManagement\Crop;
use Illuminate\Database\Eloquent\Builder;

class CropListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Crop::query()->with(['field']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('photo', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['field_id']) && $params['field_id']) $query->where('field_id', $params['field_id']);
        $sortField = in_array($sortField, Crop::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}