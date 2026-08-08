<?php

namespace App\Domain\ClinicManagement\MedicalVital\Queries;

use App\Models\ClinicManagement\MedicalVital;
use Illuminate\Database\Eloquent\Builder;

class MedicalVitalListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = MedicalVital::query()->with(['patient']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('blood_pressure', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['patient_id']) && $params['patient_id']) $query->where('patient_id', $params['patient_id']);
        $sortField = in_array($sortField, MedicalVital::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}