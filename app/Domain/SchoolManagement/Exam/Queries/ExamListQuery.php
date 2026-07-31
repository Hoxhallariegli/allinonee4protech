<?php

namespace App\Domain\SchoolManagement\Exam\Queries;

use App\Models\SchoolManagement\Exam;
use Illuminate\Database\Eloquent\Builder;

class ExamListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Exam::query()->with(['class']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['class_id']) && $params['class_id']) $query->where('class_id', $params['class_id']);
        $sortField = in_array($sortField, Exam::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}