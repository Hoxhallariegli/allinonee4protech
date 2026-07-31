<?php

namespace App\Domain\ClinicManagement\ClinicInvoice\Actions;

use App\Models\ClinicManagement\ClinicInvoice;
use App\Models\AuditTrail;

class DeleteClinicInvoiceAction
{
    public function execute(ClinicInvoice $model): bool 
    {
        AuditTrail::log($model, 'delete', 'ClinicInvoices');
        return $model->delete(); 
    }
}