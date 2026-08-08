<?php

namespace App\Domain\LegalManagement\Client\DTOs;

class ClientDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $email,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'email' => $this->email,
        ]; }
}