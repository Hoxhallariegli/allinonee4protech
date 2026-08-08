<?php

namespace App\Domain\ECommerce\Order\Queries;

use App\Models\ECommerce\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Order::query()->with(['customer']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['customer_id']) && $params['customer_id']) $query->where('customer_id', $params['customer_id']);
        $sortField = in_array($sortField, Order::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}