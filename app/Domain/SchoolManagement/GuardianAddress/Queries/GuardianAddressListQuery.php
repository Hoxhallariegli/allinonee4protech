<?php

namespace App\Domain\SchoolManagement\GuardianAddress\Queries;

use App\Models\SchoolManagement\GuardianAddress;
use Illuminate\Database\Eloquent\Builder;

class GuardianAddressListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = GuardianAddress::query()->with(['guardian']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('line1', 'like', '%' . $params['search'] . '%');
                $query->orWhere('city', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['guardian_id']) && $params['guardian_id']) $query->where('guardian_id', $params['guardian_id']);
        $sortField = in_array($sortField, GuardianAddress::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}