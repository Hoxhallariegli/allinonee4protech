<?php

namespace App\Domain\CRM\ContactAddress\Queries;

use App\Models\CRM\ContactAddress;
use Illuminate\Database\Eloquent\Builder;

class ContactAddressListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = ContactAddress::query()->with(['contact']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('address', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['contact_id']) && $params['contact_id']) $query->where('contact_id', $params['contact_id']);
        $sortField = in_array($sortField, ContactAddress::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}