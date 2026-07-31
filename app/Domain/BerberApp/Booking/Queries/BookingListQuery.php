<?php

namespace App\Domain\BerberApp\Booking\Queries;

use App\Models\BerberApp\Booking;
use Illuminate\Database\Eloquent\Builder;

class BookingListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Booking::query()->with(['barber', 'service']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('customer_name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('customer_phone', 'like', '%' . $params['search'] . '%');
                $query->orWhere('cancel_reason', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['barber_id']) && $params['barber_id']) $query->where('barber_id', $params['barber_id']);
        if (isset($params['service_id']) && $params['service_id']) $query->where('service_id', $params['service_id']);
        $sortField = in_array($sortField, Booking::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}
