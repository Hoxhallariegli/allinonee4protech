<?php

namespace App\Domain\AutoRepairManagement\Mechanic\Queries;

use App\Models\AutoRepairManagement\Mechanic;
use Illuminate\Database\Eloquent\Builder;

class MechanicListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Mechanic::query()->with(['employee']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('specialization', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['employee_id']) && $params['employee_id']) $query->where('employee_id', $params['employee_id']);
        $sortField = in_array($sortField, Mechanic::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}