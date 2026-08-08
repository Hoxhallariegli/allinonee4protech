<?php

namespace App\Domain\ECommerce\Vendor\DTOs;

class VendorDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $email,
        public readonly mixed $phone,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]; }
}