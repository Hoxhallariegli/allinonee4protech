<?php

namespace App\Domain\GymManagement\Member\Actions;

use App\Models\GymManagement\Member;
use App\Domain\GymManagement\Member\DTOs\MemberDTO;
use App\Models\AuditTrail;

class CreateMemberAction
{
    public function execute(MemberDTO $dto): Member 
    {
        $item = Member::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Members');
        return $item;
    }
}