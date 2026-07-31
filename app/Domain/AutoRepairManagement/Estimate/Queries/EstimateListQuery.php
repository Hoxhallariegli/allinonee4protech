<?php

namespace App\Domain\AutoRepairManagement\Estimate\Queries;

use App\Models\AutoRepairManagement\Estimate;
use Illuminate\Database\Eloquent\Builder;

class EstimateListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Estimate::query()->with(['jobCard']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('status', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['job_card_id']) && $params['job_card_id']) $query->where('job_card_id', $params['job_card_id']);
        $sortField = in_array($sortField, Estimate::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}