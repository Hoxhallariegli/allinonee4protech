<?php

namespace App\Domain\RealEstateCRM\Client\Actions;

use App\Models\RealEstateCRM\Client;
use App\Models\AuditTrail;

class DeleteClientAction
{
    public function execute(Client $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Clients');
        return $model->delete(); 
    }
}