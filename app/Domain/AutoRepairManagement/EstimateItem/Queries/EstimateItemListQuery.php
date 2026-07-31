<?php

namespace App\Domain\AutoRepairManagement\EstimateItem\Queries;

use App\Models\AutoRepairManagement\EstimateItem;
use Illuminate\Database\Eloquent\Builder;

class EstimateItemListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = EstimateItem::query()->with(['estimate', 'service', 'part']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['estimate_id']) && $params['estimate_id']) $query->where('estimate_id', $params['estimate_id']);
        if (isset($params['service_id']) && $params['service_id']) $query->where('service_id', $params['service_id']);
        if (isset($params['part_id']) && $params['part_id']) $query->where('part_id', $params['part_id']);
        $sortField = in_array($sortField, EstimateItem::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}