<?php

namespace App\Domain\ECommerce\OrderItem\Queries;

use App\Models\ECommerce\OrderItem;
use Illuminate\Database\Eloquent\Builder;

class OrderItemListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = OrderItem::query()->with(['order', 'product']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['order_id']) && $params['order_id']) $query->where('order_id', $params['order_id']);
        if (isset($params['product_id']) && $params['product_id']) $query->where('product_id', $params['product_id']);
        $sortField = in_array($sortField, OrderItem::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}