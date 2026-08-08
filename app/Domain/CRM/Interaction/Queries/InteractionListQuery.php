<?php

namespace App\Domain\CRM\Interaction\Queries;

use App\Models\CRM\Interaction;
use Illuminate\Database\Eloquent\Builder;

class InteractionListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Interaction::query()->with(['contact']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('type', 'like', '%' . $params['search'] . '%');
                $query->orWhere('notes', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['contact_id']) && $params['contact_id']) $query->where('contact_id', $params['contact_id']);
        $sortField = in_array($sortField, Interaction::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}