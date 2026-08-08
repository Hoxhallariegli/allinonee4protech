<?php

namespace App\Domain\HumanResources\LeaveRequest\Actions;

use App\Models\HumanResources\LeaveRequest;
use App\Domain\HumanResources\LeaveRequest\DTOs\LeaveRequestDTO;
use App\Models\AuditTrail;

class UpdateLeaveRequestAction
{
    public function execute(LeaveRequest $model, LeaveRequestDTO $dto): LeaveRequest
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'LeaveRequests');
        $model->save();
        return $model->fresh();
    }
}