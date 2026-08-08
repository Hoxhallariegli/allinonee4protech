<?php

namespace App\Domain\ClinicManagement\Prescription\Queries;

use App\Models\ClinicManagement\Prescription;
use Illuminate\Database\Eloquent\Builder;

class PrescriptionListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Prescription::query()->with(['visit']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('medicine', 'like', '%' . $params['search'] . '%');
                $query->orWhere('dosage', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['visit_id']) && $params['visit_id']) $query->where('visit_id', $params['visit_id']);
        $sortField = in_array($sortField, Prescription::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}