<?php

namespace App\Domain\ECommerce\Vendor\Actions;

use App\Models\ECommerce\Vendor;
use App\Domain\ECommerce\Vendor\DTOs\VendorDTO;
use App\Models\AuditTrail;

class UpdateVendorAction
{
    public function execute(Vendor $model, VendorDTO $dto): Vendor
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Vendors');
        $model->save();
        return $model->fresh();
    }
}