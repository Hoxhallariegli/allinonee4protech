<?php

namespace App\Domain\ClinicManagement\ClinicInvoice\Queries;

use App\Models\ClinicManagement\ClinicInvoice;
use Illuminate\Database\Eloquent\Builder;

class ClinicInvoiceListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = ClinicInvoice::query()->with(['visit.patient']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['visit_id']) && $params['visit_id']) $query->where('visit_id', $params['visit_id']);
        $sortField = in_array($sortField, ClinicInvoice::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}