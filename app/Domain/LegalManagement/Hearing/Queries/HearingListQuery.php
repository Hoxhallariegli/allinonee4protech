<?php

namespace App\Domain\LegalManagement\Hearing\Queries;

use App\Models\LegalManagement\Hearing;
use Illuminate\Database\Eloquent\Builder;

class HearingListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Hearing::query()->with(['case']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('location', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['case_id']) && $params['case_id']) $query->where('case_id', $params['case_id']);
        $sortField = in_array($sortField, Hearing::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}