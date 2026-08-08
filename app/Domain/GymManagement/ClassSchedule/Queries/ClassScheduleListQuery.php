<?php

namespace App\Domain\GymManagement\ClassSchedule\Queries;

use App\Models\GymManagement\ClassSchedule;
use Illuminate\Database\Eloquent\Builder;

class ClassScheduleListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = ClassSchedule::query()->with(['trainer']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('class_name', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['trainer_id']) && $params['trainer_id']) $query->where('trainer_id', $params['trainer_id']);
        $sortField = in_array($sortField, ClassSchedule::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}