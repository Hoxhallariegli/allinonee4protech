<?php

namespace App\Domain\ECommerce\Product\Queries;

use App\Models\ECommerce\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Product::query()->with(['vendor', 'category']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['vendor_id']) && $params['vendor_id']) $query->where('vendor_id', $params['vendor_id']);
        $sortField = in_array($sortField, Product::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}
