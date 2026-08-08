<?php

namespace App\Domain\WarehouseManagement\CustomerAddress\DTOs;

class CustomerAddressDTO
{
    public function __construct(
        public readonly mixed $customer_id,
        public readonly mixed $address,
    ) {}
    public static function fromArray(array $data): self { return new self(
            customer_id: $data['customer_id'] ?? null,
            address: $data['address'] ?? null,
        ); }
    public function toArray(): array { return [
            'customer_id' => $this->customer_id,
            'address' => $this->address,
        ]; }
}