<?php

namespace App\Domain\TravelAgency\Client\Actions;

use App\Models\TravelAgency\Client;
use App\Models\AuditTrail;

class DeleteClientAction
{
    public function execute(Client $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Clients');
        return $model->delete(); 
    }
}