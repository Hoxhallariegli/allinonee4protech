<?php

namespace App\Domain\SchoolManagement\SchoolClass\Queries;

use App\Models\SchoolManagement\SchoolClass;
use Illuminate\Database\Eloquent\Builder;

class SchoolClassListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = SchoolClass::query()->with(['teacher']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['teacher_id']) && $params['teacher_id']) $query->where('teacher_id', $params['teacher_id']);
        $sortField = in_array($sortField, SchoolClass::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}