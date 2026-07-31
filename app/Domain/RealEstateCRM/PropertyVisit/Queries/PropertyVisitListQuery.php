<?php

namespace App\Domain\RealEstateCRM\PropertyVisit\Queries;

use App\Models\RealEstateCRM\PropertyVisit;
use Illuminate\Database\Eloquent\Builder;

class PropertyVisitListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = PropertyVisit::query()->with(['property', 'client']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['property_id']) && $params['property_id']) $query->where('property_id', $params['property_id']);
        if (isset($params['client_id']) && $params['client_id']) $query->where('client_id', $params['client_id']);
        $sortField = in_array($sortField, PropertyVisit::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}