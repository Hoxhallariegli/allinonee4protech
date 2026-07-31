<?php

namespace App\Domain\WarehouseManagement\StockTransfer\Queries;

use App\Models\WarehouseManagement\StockTransfer;
use Illuminate\Database\Eloquent\Builder;

class StockTransferListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = StockTransfer::query()->with(['product', 'fromWarehouse', 'toWarehouse']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['product_id']) && $params['product_id']) $query->where('product_id', $params['product_id']);
        if (isset($params['from_warehouse_id']) && $params['from_warehouse_id']) $query->where('from_warehouse_id', $params['from_warehouse_id']);
        if (isset($params['to_warehouse_id']) && $params['to_warehouse_id']) $query->where('to_warehouse_id', $params['to_warehouse_id']);
        $sortField = in_array($sortField, StockTransfer::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}