<?php

namespace App\Domain\SchoolManagement\Assignment\Actions;

use App\Models\SchoolManagement\Assignment;
use App\Domain\SchoolManagement\Assignment\DTOs\AssignmentDTO;
use App\Models\AuditTrail;

class CreateAssignmentAction
{
    public function execute(AssignmentDTO $dto): Assignment 
    {
        $item = Assignment::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Assignments');
        return $item;
    }
}