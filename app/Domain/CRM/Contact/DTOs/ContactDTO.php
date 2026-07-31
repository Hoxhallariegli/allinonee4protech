<?php

namespace App\Domain\CRM\Contact\DTOs;

class ContactDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $company_id,
        public readonly mixed $email,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            company_id: $data['company_id'] ?? null,
            email: $data['email'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'company_id' => $this->company_id,
            'email' => $this->email,
        ]; }
}