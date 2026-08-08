<?php

namespace App\Domain\FacilityManagement\Technician\DTOs;

class TechnicianDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $specialization,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            specialization: $data['specialization'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'specialization' => $this->specialization,
        ]; }
}