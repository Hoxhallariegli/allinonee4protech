<?php

namespace App\Domain\ConstructionERP\Project\Actions;

use App\Models\ConstructionERP\Project;
use App\Domain\ConstructionERP\Project\DTOs\ProjectDTO;
use App\Models\AuditTrail;

class CreateProjectAction
{
    public function execute(ProjectDTO $dto): Project 
    {
        $item = Project::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Projects');
        return $item;
    }
}