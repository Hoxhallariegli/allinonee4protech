<?php

namespace App\Domain\CRM\ContactAddress\Actions;

use App\Models\CRM\ContactAddress;
use App\Models\AuditTrail;

class DeleteContactAddressAction
{
    public function execute(ContactAddress $model): bool 
    {
        AuditTrail::log($model, 'delete', 'ContactAddresses');
        return $model->delete(); 
    }
}