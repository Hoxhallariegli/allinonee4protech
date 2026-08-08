<?php

namespace App\Domain\GymManagement\MembershipPlan\Actions;

use App\Models\GymManagement\MembershipPlan;
use App\Models\AuditTrail;

class DeleteMembershipPlanAction
{
    public function execute(MembershipPlan $model): bool 
    {
        AuditTrail::log($model, 'delete', 'MembershipPlans');
        return $model->delete(); 
    }
}