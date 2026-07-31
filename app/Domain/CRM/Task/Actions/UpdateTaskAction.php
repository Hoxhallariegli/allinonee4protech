<?php

namespace App\Domain\CRM\Task\Actions;

use App\Models\CRM\Task;
use App\Domain\CRM\Task\DTOs\TaskDTO;
use App\Models\AuditTrail;

class UpdateTaskAction
{
    public function execute(Task $model, TaskDTO $dto): Task
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Tasks');
        $model->save();
        return $model->fresh();
    }
}