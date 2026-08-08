<?php

namespace App\Domain\HumanResources\Department\Queries;

use App\Models\HumanResources\Department;
use Illuminate\Database\Eloquent\Builder;

class DepartmentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Department::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Department::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}