<?php

namespace App\Domain\WarehouseManagement\Product\Queries;

use App\Models\WarehouseManagement\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Product::query()->with(['category']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['category_id']) && $params['category_id']) $query->where('category_id', $params['category_id']);
        $sortField = in_array($sortField, Product::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}