<?php

namespace App\Domain\SchoolManagement\Student\Queries;

use App\Models\SchoolManagement\Student;
use Illuminate\Database\Eloquent\Builder;

class StudentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Student::query()->with(['guardian', 'class']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['guardian_id']) && $params['guardian_id']) $query->where('guardian_id', $params['guardian_id']);
        if (isset($params['class_id']) && $params['class_id']) $query->where('class_id', $params['class_id']);
        $sortField = in_array($sortField, Student::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}