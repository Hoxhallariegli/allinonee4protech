<?php

namespace App\Domain\ClinicManagement\PatientAddress\Queries;

use App\Models\ClinicManagement\PatientAddress;
use Illuminate\Database\Eloquent\Builder;

class PatientAddressListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = PatientAddress::query()->with(['patient']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('line1', 'like', '%' . $params['search'] . '%');
                $query->orWhere('city', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['patient_id']) && $params['patient_id']) $query->where('patient_id', $params['patient_id']);
        $sortField = in_array($sortField, PatientAddress::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}