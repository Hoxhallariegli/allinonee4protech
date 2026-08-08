<?php

namespace App\Domain\CRM\ContactAddress\DTOs;

class ContactAddressDTO
{
    public function __construct(
        public readonly mixed $contact_id,
        public readonly mixed $address,
    ) {}
    public static function fromArray(array $data): self { return new self(
            contact_id: $data['contact_id'] ?? null,
            address: $data['address'] ?? null,
        ); }
    public function toArray(): array { return [
            'contact_id' => $this->contact_id,
            'address' => $this->address,
        ]; }
}