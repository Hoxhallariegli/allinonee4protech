<?php

namespace App\Domain\TravelAgency\TourBooking\Queries;

use App\Models\TravelAgency\TourBooking;
use Illuminate\Database\Eloquent\Builder;

class TourBookingListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = TourBooking::query()->with(['client', 'tourPackage']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['client_id']) && $params['client_id']) $query->where('client_id', $params['client_id']);
        if (isset($params['tour_package_id']) && $params['tour_package_id']) $query->where('tour_package_id', $params['tour_package_id']);
        $sortField = in_array($sortField, TourBooking::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}