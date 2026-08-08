<?php

namespace App\Domain\WarehouseManagement\Employee\Queries;

use App\Models\WarehouseManagement\Employee;
use Illuminate\Database\Eloquent\Builder;

class EmployeeListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Employee::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('position', 'like', '%' . $params['search'] . '%');
                $query->orWhere('photo', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Employee::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}