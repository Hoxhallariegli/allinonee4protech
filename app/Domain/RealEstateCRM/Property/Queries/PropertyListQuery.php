<?php

namespace App\Domain\RealEstateCRM\Property\Queries;

use App\Models\RealEstateCRM\Property;
use Illuminate\Database\Eloquent\Builder;

class PropertyListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Property::query()->with(['owner', 'agent']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('title', 'like', '%' . $params['search'] . '%');
                $query->orWhere('photo', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['owner_id']) && $params['owner_id']) $query->where('owner_id', $params['owner_id']);
        if (isset($params['agent_id']) && $params['agent_id']) $query->where('agent_id', $params['agent_id']);
        $sortField = in_array($sortField, Property::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}