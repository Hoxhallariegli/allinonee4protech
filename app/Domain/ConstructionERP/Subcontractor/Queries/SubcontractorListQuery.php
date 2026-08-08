<?php

namespace App\Domain\ConstructionERP\Subcontractor\Queries;

use App\Models\ConstructionERP\Subcontractor;
use Illuminate\Database\Eloquent\Builder;

class SubcontractorListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Subcontractor::query()->with(['project']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['project_id']) && $params['project_id']) $query->where('project_id', $params['project_id']);
        $sortField = in_array($sortField, Subcontractor::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}