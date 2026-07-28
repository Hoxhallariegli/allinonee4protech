<?php

namespace App\Domain\Appointment\Queries;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;

class AppointmentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Appointment::query()->with(['vehicle']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('status', 'like', '%' . $params['search'] . '%');
                $query->orWhere('notes', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['vehicle_id']) && $params['vehicle_id']) $query->where('vehicle_id', $params['vehicle_id']);
        $sortField = in_array($sortField, Appointment::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}