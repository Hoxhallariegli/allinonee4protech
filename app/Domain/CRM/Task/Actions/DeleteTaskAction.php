<?php

namespace App\Domain\CRM\Task\Actions;

use App\Models\CRM\Task;
use App\Models\AuditTrail;

class DeleteTaskAction
{
    public function execute(Task $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Tasks');
        return $model->delete(); 
    }
}