<?php

namespace App\Domain\GymManagement\MembershipPlan\Actions;

use App\Models\GymManagement\MembershipPlan;
use App\Domain\GymManagement\MembershipPlan\DTOs\MembershipPlanDTO;
use App\Models\AuditTrail;

class UpdateMembershipPlanAction
{
    public function execute(MembershipPlan $model, MembershipPlanDTO $dto): MembershipPlan
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'MembershipPlans');
        $model->save();
        return $model->fresh();
    }
}