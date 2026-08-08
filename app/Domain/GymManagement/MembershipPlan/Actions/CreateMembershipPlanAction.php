<?php

namespace App\Domain\GymManagement\MembershipPlan\Actions;

use App\Models\GymManagement\MembershipPlan;
use App\Domain\GymManagement\MembershipPlan\DTOs\MembershipPlanDTO;
use App\Models\AuditTrail;

class CreateMembershipPlanAction
{
    public function execute(MembershipPlanDTO $dto): MembershipPlan 
    {
        $item = MembershipPlan::create($dto->toArray());
        AuditTrail::log($item, 'create', 'MembershipPlans');
        return $item;
    }
}