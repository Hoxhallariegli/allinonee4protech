<?php

namespace App\Domain\CRM\Lead\DTOs;

class LeadDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $company_id,
        public readonly mixed $source,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            company_id: $data['company_id'] ?? null,
            source: $data['source'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'company_id' => $this->company_id,
            'source' => $this->source,
            'status' => $this->status,
        ]; }
}