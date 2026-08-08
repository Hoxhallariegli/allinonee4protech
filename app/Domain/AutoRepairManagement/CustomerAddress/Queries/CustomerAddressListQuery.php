<?php

namespace App\Domain\AutoRepairManagement\CustomerAddress\Queries;

use App\Models\AutoRepairManagement\CustomerAddress;
use Illuminate\Database\Eloquent\Builder;

class CustomerAddressListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = CustomerAddress::query()->with(['customer']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('address', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['customer_id']) && $params['customer_id']) $query->where('customer_id', $params['customer_id']);
        $sortField = in_array($sortField, CustomerAddress::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}