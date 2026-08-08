<?php

namespace App\Domain\LegalManagement\Billing\Queries;

use App\Models\LegalManagement\Billing;
use Illuminate\Database\Eloquent\Builder;

class BillingListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Billing::query()->with(['case']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['case_id']) && $params['case_id']) $query->where('case_id', $params['case_id']);
        $sortField = in_array($sortField, Billing::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}