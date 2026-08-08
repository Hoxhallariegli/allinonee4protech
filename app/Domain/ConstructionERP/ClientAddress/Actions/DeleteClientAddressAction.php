<?php

namespace App\Domain\ConstructionERP\ClientAddress\Actions;

use App\Models\ConstructionERP\ClientAddress;
use App\Models\AuditTrail;

class DeleteClientAddressAction
{
    public function execute(ClientAddress $model): bool 
    {
        AuditTrail::log($model, 'delete', 'ClientAddresses');
        return $model->delete(); 
    }
}