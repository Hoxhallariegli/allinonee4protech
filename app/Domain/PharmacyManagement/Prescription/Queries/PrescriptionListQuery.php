<?php

namespace App\Domain\PharmacyManagement\Prescription\Queries;

use App\Models\PharmacyManagement\Prescription;
use Illuminate\Database\Eloquent\Builder;

class PrescriptionListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Prescription::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('patient_name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('doctor_name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('photo', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Prescription::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}