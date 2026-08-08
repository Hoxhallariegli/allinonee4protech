<?php

namespace App\Domain\AutoRepairManagement\ExpenseTracking\Queries;

use App\Models\AutoRepairManagement\ExpenseTracking;
use Illuminate\Database\Eloquent\Builder;

class ExpenseTrackingListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = ExpenseTracking::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, ExpenseTracking::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}