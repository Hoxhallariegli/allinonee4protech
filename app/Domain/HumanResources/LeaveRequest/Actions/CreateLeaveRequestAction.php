<?php

namespace App\Domain\HumanResources\LeaveRequest\Actions;

use App\Models\HumanResources\LeaveRequest;
use App\Domain\HumanResources\LeaveRequest\DTOs\LeaveRequestDTO;
use App\Models\AuditTrail;

class CreateLeaveRequestAction
{
    public function execute(LeaveRequestDTO $dto): LeaveRequest 
    {
        $item = LeaveRequest::create($dto->toArray());
        AuditTrail::log($item, 'create', 'LeaveRequests');
        return $item;
    }
}