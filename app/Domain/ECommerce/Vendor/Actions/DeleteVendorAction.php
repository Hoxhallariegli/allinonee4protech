<?php

namespace App\Domain\ECommerce\Vendor\Actions;

use App\Models\ECommerce\Vendor;
use App\Models\AuditTrail;

class DeleteVendorAction
{
    public function execute(Vendor $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Vendors');
        return $model->delete(); 
    }
}