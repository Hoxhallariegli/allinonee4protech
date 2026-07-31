<?php

namespace App\Domain\CRM\Lead\Queries;

use App\Models\CRM\Lead;
use Illuminate\Database\Eloquent\Builder;

class LeadListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Lead::query()->with(['company']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('source', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['company_id']) && $params['company_id']) $query->where('company_id', $params['company_id']);
        $sortField = in_array($sortField, Lead::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}