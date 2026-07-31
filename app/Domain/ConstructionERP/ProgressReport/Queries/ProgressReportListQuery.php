<?php

namespace App\Domain\ConstructionERP\ProgressReport\Queries;

use App\Models\ConstructionERP\ProgressReport;
use Illuminate\Database\Eloquent\Builder;

class ProgressReportListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = ProgressReport::query()->with(['project']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['project_id']) && $params['project_id']) $query->where('project_id', $params['project_id']);
        $sortField = in_array($sortField, ProgressReport::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}