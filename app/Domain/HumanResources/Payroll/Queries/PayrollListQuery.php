<?php

namespace App\Domain\HumanResources\Payroll\Queries;

use App\Models\HumanResources\Payroll;
use Illuminate\Database\Eloquent\Builder;

class PayrollListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Payroll::query()->with(['employee']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('month', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['employee_id']) && $params['employee_id']) $query->where('employee_id', $params['employee_id']);
        $sortField = in_array($sortField, Payroll::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}