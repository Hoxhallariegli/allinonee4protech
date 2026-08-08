<?php

namespace App\Domain\GymManagement\Subscription\Actions;

use App\Models\GymManagement\Subscription;
use App\Domain\GymManagement\Subscription\DTOs\SubscriptionDTO;
use App\Models\AuditTrail;

class CreateSubscriptionAction
{
    public function execute(SubscriptionDTO $dto): Subscription 
    {
        $item = Subscription::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Subscriptions');
        return $item;
    }
}