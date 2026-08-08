<?php

namespace App\Domain\LegalManagement\Client\Actions;

use App\Models\LegalManagement\Client;
use App\Models\AuditTrail;

class DeleteClientAction
{
    public function execute(Client $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Clients');
        return $model->delete(); 
    }
}