<?php

namespace App\Domain\SchoolManagement\Grade\Actions;

use App\Models\SchoolManagement\Grade;
use App\Domain\SchoolManagement\Grade\DTOs\GradeDTO;
use App\Models\AuditTrail;

class CreateGradeAction
{
    public function execute(GradeDTO $dto): Grade 
    {
        $item = Grade::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Grades');
        return $item;
    }
}