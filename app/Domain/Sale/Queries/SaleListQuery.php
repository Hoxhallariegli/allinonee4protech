<?php

namespace App\Domain\Sale\Queries;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;

class SaleListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Sale::query()->with(['user', 'product']);
        if (isset($params['search']) && $params['search']) {
            $query->where('id', 'like', '%' . $params['search'] . '%');
        }
        if (isset($params['user_id']) && $params['user_id']) $query->where('user_id', $params['user_id']);
        if (isset($params['product_id']) && $params['product_id']) $query->where('product_id', $params['product_id']);
        if (isset($params['status']) && $params['status']) $query->where('status', $params['status']);

        return $query->orderBy($sortField, $sortAsc);
    }
}