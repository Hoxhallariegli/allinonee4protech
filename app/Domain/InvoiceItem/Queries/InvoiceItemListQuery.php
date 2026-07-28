<?php

namespace App\Domain\InvoiceItem\Queries;

use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Builder;

class InvoiceItemListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = InvoiceItem::query()->with(['invoice', 'service', 'part']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['invoice_id']) && $params['invoice_id']) $query->where('invoice_id', $params['invoice_id']);
        if (isset($params['service_id']) && $params['service_id']) $query->where('service_id', $params['service_id']);
        if (isset($params['part_id']) && $params['part_id']) $query->where('part_id', $params['part_id']);
        $sortField = in_array($sortField, InvoiceItem::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}