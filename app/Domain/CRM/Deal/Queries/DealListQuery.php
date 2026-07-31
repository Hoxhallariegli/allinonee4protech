<?php

namespace App\Domain\CRM\Deal\Queries;

use App\Models\CRM\Deal;
use Illuminate\Database\Eloquent\Builder;

class DealListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Deal::query()->with(['contact']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['contact_id']) && $params['contact_id']) $query->where('contact_id', $params['contact_id']);
        $sortField = in_array($sortField, Deal::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}