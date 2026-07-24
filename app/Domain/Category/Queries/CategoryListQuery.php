<?php

namespace App\Domain\Category\Queries;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Category::query();
        if (isset($params['search']) && $params['search']) {
            $query->where('id', 'like', '%' . $params['search'] . '%');
        }

        return $query->orderBy($sortField, $sortAsc);
    }
}