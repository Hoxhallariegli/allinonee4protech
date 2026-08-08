<?php

namespace App\Domain\GymManagement\Subscription\Actions;

use App\Models\GymManagement\Subscription;
use App\Domain\GymManagement\Subscription\DTOs\SubscriptionDTO;
use App\Models\AuditTrail;

class UpdateSubscriptionAction
{
    public function execute(Subscription $model, SubscriptionDTO $dto): Subscription
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Subscriptions');
        $model->save();
        return $model->fresh();
    }
}