<?php

namespace App\Domain\RestaurantPOS\Order\Queries;

use App\Models\RestaurantPOS\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Order::query()->with(['table', 'waiter']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['table_id']) && $params['table_id']) $query->where('table_id', $params['table_id']);
        if (isset($params['waiter_id']) && $params['waiter_id']) $query->where('waiter_id', $params['waiter_id']);
        $sortField = in_array($sortField, Order::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}