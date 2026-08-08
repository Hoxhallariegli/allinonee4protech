<?php

namespace App\Domain\PharmacyManagement\PrescriptionItem\Queries;

use App\Models\PharmacyManagement\PrescriptionItem;
use Illuminate\Database\Eloquent\Builder;

class PrescriptionItemListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = PrescriptionItem::query()->with(['prescription', 'medicine']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['prescription_id']) && $params['prescription_id']) $query->where('prescription_id', $params['prescription_id']);
        if (isset($params['medicine_id']) && $params['medicine_id']) $query->where('medicine_id', $params['medicine_id']);
        $sortField = in_array($sortField, PrescriptionItem::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}