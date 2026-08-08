<?php

namespace App\Domain\EventManagement\TicketType\Queries;

use App\Models\EventManagement\TicketType;
use Illuminate\Database\Eloquent\Builder;

class TicketTypeListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = TicketType::query()->with(['event']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['event_id']) && $params['event_id']) $query->where('event_id', $params['event_id']);
        $sortField = in_array($sortField, TicketType::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}