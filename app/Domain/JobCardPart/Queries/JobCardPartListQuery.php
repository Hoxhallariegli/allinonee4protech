<?php

namespace App\Domain\JobCardPart\Queries;

use App\Models\JobCardPart;
use Illuminate\Database\Eloquent\Builder;

class JobCardPartListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = JobCardPart::query()->with(['jobCard', 'part']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['job_card_id']) && $params['job_card_id']) $query->where('job_card_id', $params['job_card_id']);
        if (isset($params['part_id']) && $params['part_id']) $query->where('part_id', $params['part_id']);
        $sortField = in_array($sortField, JobCardPart::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}