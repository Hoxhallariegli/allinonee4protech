<?php

namespace App\Domain\AutoRepairManagement\PurchaseOrderItem\Queries;

use App\Models\AutoRepairManagement\PurchaseOrderItem;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrderItemListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = PurchaseOrderItem::query()->with(['purchaseOrder', 'part']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['purchase_order_id']) && $params['purchase_order_id']) $query->where('purchase_order_id', $params['purchase_order_id']);
        if (isset($params['part_id']) && $params['part_id']) $query->where('part_id', $params['part_id']);
        $sortField = in_array($sortField, PurchaseOrderItem::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}