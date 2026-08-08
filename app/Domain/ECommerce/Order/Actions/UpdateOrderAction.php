<?php

namespace App\Domain\ECommerce\Order\Actions;

use App\Models\ECommerce\Order;
use App\Domain\ECommerce\Order\DTOs\OrderDTO;
use App\Models\AuditTrail;

class UpdateOrderAction
{
    public function execute(Order $model, OrderDTO $dto): Order
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Orders');
        $model->save();
        return $model->fresh();
    }
}