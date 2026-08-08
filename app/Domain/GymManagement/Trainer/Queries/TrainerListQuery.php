<?php

namespace App\Domain\GymManagement\Trainer\Queries;

use App\Models\GymManagement\Trainer;
use Illuminate\Database\Eloquent\Builder;

class TrainerListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Trainer::query();
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('name', 'like', '%' . $params['search'] . '%');
                $query->orWhere('specialization', 'like', '%' . $params['search'] . '%');
                $query->orWhere('photo', 'like', '%' . $params['search'] . '%');
            });
        }

        $sortField = in_array($sortField, Trainer::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}