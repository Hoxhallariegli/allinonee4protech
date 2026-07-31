<?php

namespace App\Domain\WarehouseManagement\PurchaseOrder\Queries;

use App\Models\WarehouseManagement\PurchaseOrder;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrderListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = PurchaseOrder::query()->with(['supplier']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['supplier_id']) && $params['supplier_id']) $query->where('supplier_id', $params['supplier_id']);
        $sortField = in_array($sortField, PurchaseOrder::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}