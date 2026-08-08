<?php

namespace App\Domain\SchoolManagement\GuardianAddress\DTOs;

class GuardianAddressDTO
{
    public function __construct(
        public readonly mixed $guardian_id,
        public readonly mixed $line1,
        public readonly mixed $city,
    ) {}
    public static function fromArray(array $data): self { return new self(
            guardian_id: $data['guardian_id'] ?? null,
            line1: $data['line1'] ?? null,
            city: $data['city'] ?? null,
        ); }
    public function toArray(): array { return [
            'guardian_id' => $this->guardian_id,
            'line1' => $this->line1,
            'city' => $this->city,
        ]; }
}