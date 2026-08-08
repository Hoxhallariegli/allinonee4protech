<?php

namespace App\Domain\CRM\Company\DTOs;

class CompanyDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $industry,
        public readonly mixed $phone,
        public readonly mixed $logo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            industry: $data['industry'] ?? null,
            phone: $data['phone'] ?? null,
            logo: $data['logo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'industry' => $this->industry,
            'phone' => $this->phone,
            'logo' => $this->logo,
        ]; }
}