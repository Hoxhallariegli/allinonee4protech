<?php

namespace App\Domain\RestaurantPOS\OrderItem\Queries;

use App\Models\RestaurantPOS\OrderItem;
use Illuminate\Database\Eloquent\Builder;

class OrderItemListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = OrderItem::query()->with(['order', 'menuItem']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['order_id']) && $params['order_id']) $query->where('order_id', $params['order_id']);
        if (isset($params['menu_item_id']) && $params['menu_item_id']) $query->where('menu_item_id', $params['menu_item_id']);
        $sortField = in_array($sortField, OrderItem::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}