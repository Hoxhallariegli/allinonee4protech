<?php

namespace App\Domain\Product\Queries;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Product::query()->with(['category']);
        if (isset($params['search']) && $params['search']) {
            $query->where('id', 'like', '%' . $params['search'] . '%');
        }
        if (isset($params['category_id']) && $params['category_id']) $query->where('category_id', $params['category_id']);

        return $query->orderBy($sortField, $sortAsc);
    }
}