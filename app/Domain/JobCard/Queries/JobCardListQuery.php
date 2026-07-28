<?php

namespace App\Domain\JobCard\Queries;

use App\Models\JobCard;
use Illuminate\Database\Eloquent\Builder;

class JobCardListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = JobCard::query()->with(['vehicle', 'customer', 'mechanic.employee']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('status', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['vehicle_id']) && $params['vehicle_id']) $query->where('vehicle_id', $params['vehicle_id']);
        if (isset($params['customer_id']) && $params['customer_id']) $query->where('customer_id', $params['customer_id']);
        if (isset($params['mechanic_id']) && $params['mechanic_id']) $query->where('mechanic_id', $params['mechanic_id']);
        $sortField = in_array($sortField, JobCard::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}