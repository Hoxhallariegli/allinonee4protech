<?php

namespace App\Domain\CRM\Task\Actions;

use App\Models\CRM\Task;
use App\Domain\CRM\Task\DTOs\TaskDTO;
use App\Models\AuditTrail;

class CreateTaskAction
{
    public function execute(TaskDTO $dto): Task 
    {
        $item = Task::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Tasks');
        return $item;
    }
}