<?php

namespace App\Domain\ConstructionERP\Client\Actions;

use App\Models\ConstructionERP\Client;
use App\Models\AuditTrail;

class DeleteClientAction
{
    public function execute(Client $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Clients');
        return $model->delete(); 
    }
}