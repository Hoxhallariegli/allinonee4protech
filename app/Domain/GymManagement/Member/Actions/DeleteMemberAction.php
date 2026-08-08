<?php

namespace App\Domain\GymManagement\Member\Actions;

use App\Models\GymManagement\Member;
use App\Models\AuditTrail;

class DeleteMemberAction
{
    public function execute(Member $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Members');
        return $model->delete(); 
    }
}