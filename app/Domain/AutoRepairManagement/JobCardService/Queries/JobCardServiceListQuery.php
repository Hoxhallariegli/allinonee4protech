<?php

namespace App\Domain\AutoRepairManagement\JobCardService\Queries;

use App\Models\AutoRepairManagement\JobCardService;
use Illuminate\Database\Eloquent\Builder;

class JobCardServiceListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = JobCardService::query()->with(['jobCard', 'service']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['job_card_id']) && $params['job_card_id']) $query->where('job_card_id', $params['job_card_id']);
        if (isset($params['service_id']) && $params['service_id']) $query->where('service_id', $params['service_id']);
        $sortField = in_array($sortField, JobCardService::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}