<?php

namespace App\Domain\CRM\Task\Queries;

use App\Models\CRM\Task;
use Illuminate\Database\Eloquent\Builder;

class TaskListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Task::query()->with(['deal']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('title', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['deal_id']) && $params['deal_id']) $query->where('deal_id', $params['deal_id']);
        $sortField = in_array($sortField, Task::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}