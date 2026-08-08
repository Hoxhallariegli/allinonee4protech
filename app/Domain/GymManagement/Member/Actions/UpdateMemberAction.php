<?php

namespace App\Domain\GymManagement\Member\Actions;

use App\Models\GymManagement\Member;
use App\Domain\GymManagement\Member\DTOs\MemberDTO;
use App\Models\AuditTrail;

class UpdateMemberAction
{
    public function execute(Member $model, MemberDTO $dto): Member
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Members');
        $model->save();
        return $model->fresh();
    }
}