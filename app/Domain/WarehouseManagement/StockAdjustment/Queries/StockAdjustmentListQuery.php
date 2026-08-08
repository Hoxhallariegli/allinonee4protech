<?php

namespace App\Domain\WarehouseManagement\StockAdjustment\Queries;

use App\Models\WarehouseManagement\StockAdjustment;
use Illuminate\Database\Eloquent\Builder;

class StockAdjustmentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = StockAdjustment::query()->with(['product', 'warehouse']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('reason', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['product_id']) && $params['product_id']) $query->where('product_id', $params['product_id']);
        if (isset($params['warehouse_id']) && $params['warehouse_id']) $query->where('warehouse_id', $params['warehouse_id']);
        $sortField = in_array($sortField, StockAdjustment::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}