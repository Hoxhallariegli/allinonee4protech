<?php

namespace App\Domain\SchoolManagement\Student\Actions;

use App\Models\SchoolManagement\Student;
use App\Domain\SchoolManagement\Student\DTOs\StudentDTO;
use App\Models\AuditTrail;

class CreateStudentAction
{
    public function execute(StudentDTO $dto): Student 
    {
        $item = Student::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Students');
        return $item;
    }
}