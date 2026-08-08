<?php

namespace App\Domain\EventManagement\Attendee\Queries;

use App\Models\EventManagement\Attendee;
use Illuminate\Database\Eloquent\Builder;

class AttendeeListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Attendee::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('email', 'like', '%' . $params['search'] . '%');
                $query->orWhere('phone', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Attendee::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}