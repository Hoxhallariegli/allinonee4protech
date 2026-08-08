<?php

namespace App\Domain\Finance\Budget\Queries;

use App\Models\Finance\Budget;
use Illuminate\Database\Eloquent\Builder;

class BudgetListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Budget::query()->with(['category']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('period', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['category_id']) && $params['category_id']) $query->where('category_id', $params['category_id']);
        $sortField = in_array($sortField, Budget::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}