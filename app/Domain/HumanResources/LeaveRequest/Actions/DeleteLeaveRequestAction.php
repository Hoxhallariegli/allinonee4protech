<?php

namespace App\Domain\HumanResources\LeaveRequest\Actions;

use App\Models\HumanResources\LeaveRequest;
use App\Models\AuditTrail;

class DeleteLeaveRequestAction
{
    public function execute(LeaveRequest $model): bool 
    {
        AuditTrail::log($model, 'delete', 'LeaveRequests');
        return $model->delete(); 
    }
}