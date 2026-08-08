<?php

namespace App\Domain\TravelAgency\TourPackage\Queries;

use App\Models\TravelAgency\TourPackage;
use Illuminate\Database\Eloquent\Builder;

class TourPackageListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = TourPackage::query()->with(['destination']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('photo', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['destination_id']) && $params['destination_id']) $query->where('destination_id', $params['destination_id']);
        $sortField = in_array($sortField, TourPackage::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}