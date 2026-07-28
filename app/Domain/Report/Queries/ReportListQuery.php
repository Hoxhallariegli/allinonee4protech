<?php

namespace App\Domain\Report\Queries;

use App\Models\Report;
use Illuminate\Database\Eloquent\Builder;

class ReportListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Report::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('report_type', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Report::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}