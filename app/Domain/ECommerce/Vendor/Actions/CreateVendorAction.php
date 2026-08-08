<?php

namespace App\Domain\ECommerce\Vendor\Actions;

use App\Models\ECommerce\Vendor;
use App\Domain\ECommerce\Vendor\DTOs\VendorDTO;
use App\Models\AuditTrail;

class CreateVendorAction
{
    public function execute(VendorDTO $dto): Vendor 
    {
        $item = Vendor::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Vendors');
        return $item;
    }
}