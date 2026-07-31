<?php

namespace App\Domain\ConstructionERP\Project\Actions;

use App\Models\ConstructionERP\Project;
use App\Domain\ConstructionERP\Project\DTOs\ProjectDTO;
use App\Models\AuditTrail;

class UpdateProjectAction
{
    public function execute(Project $model, ProjectDTO $dto): Project
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Projects');
        $model->save();
        return $model->fresh();
    }
}