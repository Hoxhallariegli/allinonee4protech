<?php

namespace App\Domain\SchoolManagement\Subject\Queries;

use App\Models\SchoolManagement\Subject;
use Illuminate\Database\Eloquent\Builder;

class SubjectListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Subject::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('code', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Subject::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}