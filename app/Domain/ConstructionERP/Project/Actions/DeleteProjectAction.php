<?php

namespace App\Domain\ConstructionERP\Project\Actions;

use App\Models\ConstructionERP\Project;
use App\Models\AuditTrail;

class DeleteProjectAction
{
    public function execute(Project $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Projects');
        return $model->delete(); 
    }
}