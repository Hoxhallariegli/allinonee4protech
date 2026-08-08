<?php

namespace App\Domain\ConstructionERP\ClientAddress\DTOs;

class ClientAddressDTO
{
    public function __construct(
        public readonly mixed $client_id,
        public readonly mixed $address,
    ) {}
    public static function fromArray(array $data): self { return new self(
            client_id: $data['client_id'] ?? null,
            address: $data['address'] ?? null,
        ); }
    public function toArray(): array { return [
            'client_id' => $this->client_id,
            'address' => $this->address,
        ]; }
}