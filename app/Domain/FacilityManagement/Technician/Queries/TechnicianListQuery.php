<?php

namespace App\Domain\FacilityManagement\Technician\Queries;

use App\Models\FacilityManagement\Technician;
use Illuminate\Database\Eloquent\Builder;

class TechnicianListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Technician::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('specialization', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Technician::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}