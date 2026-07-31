<?php

namespace App\Domain\SchoolManagement\Attendance\Queries;

use App\Models\SchoolManagement\Attendance;
use Illuminate\Database\Eloquent\Builder;

class AttendanceListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Attendance::query()->with(['student', 'class']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['student_id']) && $params['student_id']) $query->where('student_id', $params['student_id']);
        if (isset($params['class_id']) && $params['class_id']) $query->where('class_id', $params['class_id']);
        $sortField = in_array($sortField, Attendance::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}