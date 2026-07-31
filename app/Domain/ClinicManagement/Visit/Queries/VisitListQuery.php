<?php

namespace App\Domain\ClinicManagement\Visit\Queries;

use App\Models\ClinicManagement\Visit;
use Illuminate\Database\Eloquent\Builder;

class VisitListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Visit::query()->with(['patient', 'doctor']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('diagnosis', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['patient_id']) && $params['patient_id']) $query->where('patient_id', $params['patient_id']);
        if (isset($params['doctor_id']) && $params['doctor_id']) $query->where('doctor_id', $params['doctor_id']);
        $sortField = in_array($sortField, Visit::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}