<?php

namespace App\Domain\RealEstateCRM\ClientAddress\Actions;

use App\Models\RealEstateCRM\ClientAddress;
use App\Models\AuditTrail;

class DeleteClientAddressAction
{
    public function execute(ClientAddress $model): bool 
    {
        AuditTrail::log($model, 'delete', 'ClientAddresses');
        return $model->delete(); 
    }
}