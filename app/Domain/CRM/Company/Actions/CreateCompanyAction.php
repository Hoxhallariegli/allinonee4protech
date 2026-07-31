<?php

namespace App\Domain\CRM\Company\Actions;

use App\Models\CRM\Company;
use App\Domain\CRM\Company\DTOs\CompanyDTO;
use App\Models\AuditTrail;

class CreateCompanyAction
{
    public function execute(CompanyDTO $dto): Company 
    {
        $item = Company::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Companies');
        return $item;
    }
}