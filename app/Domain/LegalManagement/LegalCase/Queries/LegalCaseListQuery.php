<?php

namespace App\Domain\LegalManagement\LegalCase\Queries;

use App\Models\LegalManagement\LegalCase;
use Illuminate\Database\Eloquent\Builder;

class LegalCaseListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = LegalCase::query()->with(['client']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('title', 'like', '%' . $params['search'] . '%');
                $query->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['client_id']) && $params['client_id']) $query->where('client_id', $params['client_id']);
        $sortField = in_array($sortField, LegalCase::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}