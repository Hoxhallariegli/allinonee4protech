<?php

namespace App\Domain\LegalManagement\Document\Queries;

use App\Models\LegalManagement\Document;
use Illuminate\Database\Eloquent\Builder;

class DocumentListQuery
{
    public function handle(array $params = [], string $sortField = 'id', string $sortAsc = 'asc'): Builder
    {
        $query = Document::query()->with(['case']);
        if (isset($params['search']) && $params['search']) {
            $query->where(function($query) use ($params) {
                $query->where('id', 'like', '%' . $params['search'] . '%');
                $query->orWhere('title', 'like', '%' . $params['search'] . '%');
                $query->orWhere('file_path', 'like', '%' . $params['search'] . '%');
            });
        }
        if (isset($params['case_id']) && $params['case_id']) $query->where('case_id', $params['case_id']);
        $sortField = in_array($sortField, Document::sortable(), true) ? $sortField : 'id';
        $sortAsc = in_array(strtolower((string) $sortAsc), ['asc', 'desc'], true) ? $sortAsc : 'asc';
        return $query->orderBy($sortField, $sortAsc);
    }
}