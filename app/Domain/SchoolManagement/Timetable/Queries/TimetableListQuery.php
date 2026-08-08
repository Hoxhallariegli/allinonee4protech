<?php

namespace App\Domain\SchoolManagement\Timetable\Queries;

use App\Models\SchoolManagement\Timetable;
use Illuminate\Database\Eloquent\Builder;

class TimetableListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Timetable::query()->with(['schoolClass', 'subject', 'teacher']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('start_time', 'like', '%' . $params['search'] . '%');
                $query->orWhere('end_time', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['school_class_id']) && $params['school_class_id']) $query->where('school_class_id', $params['school_class_id']);
        if (isset($params['subject_id']) && $params['subject_id']) $query->where('subject_id', $params['subject_id']);
        if (isset($params['teacher_id']) && $params['teacher_id']) $query->where('teacher_id', $params['teacher_id']);
        $sortField = in_array($sortField, Timetable::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}