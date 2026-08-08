<?php

namespace App\Domain\CRM\Company\Queries;

use App\Models\CRM\Company;
use Illuminate\Database\Eloquent\Builder;

class CompanyListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Company::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('industry', 'like', '%' . $params['search'] . '%');
                $query->orWhere('phone', 'like', '%' . $params['search'] . '%');
                $query->orWhere('logo', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Company::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}