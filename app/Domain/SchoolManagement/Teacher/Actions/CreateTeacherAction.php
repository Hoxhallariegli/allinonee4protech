<?php

namespace App\Domain\SchoolManagement\Teacher\Actions;

use App\Models\SchoolManagement\Teacher;
use App\Domain\SchoolManagement\Teacher\DTOs\TeacherDTO;
use App\Models\AuditTrail;

class CreateTeacherAction
{
    public function execute(TeacherDTO $dto): Teacher 
    {
        $item = Teacher::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Teachers');
        return $item;
    }
}