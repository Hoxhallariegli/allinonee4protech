<?php

namespace App\Domain\RealEstateCRM\ClientAddress\Queries;

use App\Models\RealEstateCRM\ClientAddress;
use Illuminate\Database\Eloquent\Builder;

class ClientAddressListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = ClientAddress::query()->with(['client']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('address', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['client_id']) && $params['client_id']) $query->where('client_id', $params['client_id']);
        $sortField = in_array($sortField, ClientAddress::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}