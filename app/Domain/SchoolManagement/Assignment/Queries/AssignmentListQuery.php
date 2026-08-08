<?php

namespace App\Domain\SchoolManagement\Assignment\Queries;

use App\Models\SchoolManagement\Assignment;
use Illuminate\Database\Eloquent\Builder;

class AssignmentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Assignment::query()->with(['schoolClass', 'subject']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('title', 'like', '%' . $params['search'] . '%');
                $query->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['school_class_id']) && $params['school_class_id']) $query->where('school_class_id', $params['school_class_id']);
        if (isset($params['subject_id']) && $params['subject_id']) $query->where('subject_id', $params['subject_id']);
        $sortField = in_array($sortField, Assignment::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}