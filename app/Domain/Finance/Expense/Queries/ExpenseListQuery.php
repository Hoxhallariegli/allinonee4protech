<?php

namespace App\Domain\Finance\Expense\Queries;

use App\Models\Finance\Expense;
use Illuminate\Database\Eloquent\Builder;

class ExpenseListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Expense::query()->with(['category']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('attachment_file', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['category_id']) && $params['category_id']) $query->where('category_id', $params['category_id']);
        $sortField = in_array($sortField, Expense::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}