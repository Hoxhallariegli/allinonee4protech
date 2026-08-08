<?php

namespace App\Domain\HumanResources\Attendance\Queries;

use App\Models\HumanResources\Attendance;
use Illuminate\Database\Eloquent\Builder;

class AttendanceListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Attendance::query()->with(['employee']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['employee_id']) && $params['employee_id']) $query->where('employee_id', $params['employee_id']);
        $sortField = in_array($sortField, Attendance::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}