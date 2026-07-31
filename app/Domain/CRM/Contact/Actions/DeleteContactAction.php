<?php

namespace App\Domain\CRM\Contact\Actions;

use App\Models\CRM\Contact;
use App\Models\AuditTrail;

class DeleteContactAction
{
    public function execute(Contact $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Contacts');
        return $model->delete(); 
    }
}