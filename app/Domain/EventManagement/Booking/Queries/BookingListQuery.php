<?php

namespace App\Domain\EventManagement\Booking\Queries;

use App\Models\EventManagement\Booking;
use Illuminate\Database\Eloquent\Builder;

class BookingListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Booking::query()->with(['event', 'attendee']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['event_id']) && $params['event_id']) $query->where('event_id', $params['event_id']);
        if (isset($params['attendee_id']) && $params['attendee_id']) $query->where('attendee_id', $params['attendee_id']);
        $sortField = in_array($sortField, Booking::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}