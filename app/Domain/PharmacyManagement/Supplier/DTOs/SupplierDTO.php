<?php

namespace App\Domain\PharmacyManagement\Supplier\DTOs;

class SupplierDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $phone,
        public readonly mixed $email,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            phone: $data['phone'] ?? null,
            email: $data['email'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]; }
}