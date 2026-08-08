<?php

namespace App\Domain\Finance\Transaction\Queries;

use App\Models\Finance\Transaction;
use Illuminate\Database\Eloquent\Builder;

class TransactionListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Transaction::query()->with(['account', 'category']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['account_id']) && $params['account_id']) $query->where('account_id', $params['account_id']);
        if (isset($params['category_id']) && $params['category_id']) $query->where('category_id', $params['category_id']);
        $sortField = in_array($sortField, Transaction::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}