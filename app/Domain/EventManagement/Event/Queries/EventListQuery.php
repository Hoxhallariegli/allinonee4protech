<?php

namespace App\Domain\EventManagement\Event\Queries;

use App\Models\EventManagement\Event;
use Illuminate\Database\Eloquent\Builder;

class EventListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Event::query()->with(['organizer']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('title', 'like', '%' . $params['search'] . '%');
                $query->orWhere('location', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['organizer_id']) && $params['organizer_id']) $query->where('organizer_id', $params['organizer_id']);
        $sortField = in_array($sortField, Event::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}