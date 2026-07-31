<?php

namespace App\Domain\SchoolManagement\Grade\Queries;

use App\Models\SchoolManagement\Grade;
use Illuminate\Database\Eloquent\Builder;

class GradeListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Grade::query()->with(['student', 'exam']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['student_id']) && $params['student_id']) $query->where('student_id', $params['student_id']);
        if (isset($params['exam_id']) && $params['exam_id']) $query->where('exam_id', $params['exam_id']);
        $sortField = in_array($sortField, Grade::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}