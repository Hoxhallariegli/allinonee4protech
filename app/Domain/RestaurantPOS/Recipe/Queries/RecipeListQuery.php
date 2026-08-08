<?php

namespace App\Domain\RestaurantPOS\Recipe\Queries;

use App\Models\RestaurantPOS\Recipe;
use Illuminate\Database\Eloquent\Builder;

class RecipeListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Recipe::query()->with(['menuItem', 'ingredient']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['menu_item_id']) && $params['menu_item_id']) $query->where('menu_item_id', $params['menu_item_id']);
        if (isset($params['ingredient_id']) && $params['ingredient_id']) $query->where('ingredient_id', $params['ingredient_id']);
        $sortField = in_array($sortField, Recipe::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}