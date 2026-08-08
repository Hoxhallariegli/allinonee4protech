<?php

namespace App\Domain\GymManagement\Subscription\Actions;

use App\Models\GymManagement\Subscription;
use App\Models\AuditTrail;

class DeleteSubscriptionAction
{
    public function execute(Subscription $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Subscriptions');
        return $model->delete(); 
    }
}