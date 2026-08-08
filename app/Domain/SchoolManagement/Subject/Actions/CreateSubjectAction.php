<?php

namespace App\Domain\SchoolManagement\Subject\Actions;

use App\Models\SchoolManagement\Subject;
use App\Domain\SchoolManagement\Subject\DTOs\SubjectDTO;
use App\Models\AuditTrail;

class CreateSubjectAction
{
    public function execute(SubjectDTO $dto): Subject 
    {
        $item = Subject::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Subjects');
        return $item;
    }
}