<?php

namespace App\Domain\GymManagement\Subscription\Queries;

use App\Models\GymManagement\Subscription;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Subscription::query()->with(['member']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');

            });
        }
        if (isset($params['member_id']) && $params['member_id']) $query->where('member_id', $params['member_id']);
        $sortField = in_array($sortField, Subscription::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}