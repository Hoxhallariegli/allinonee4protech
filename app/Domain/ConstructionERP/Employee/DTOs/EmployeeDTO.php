<?php

namespace App\Domain\ConstructionERP\Employee\DTOs;

class EmployeeDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $position,
        public readonly mixed $phone,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            position: $data['position'] ?? null,
            phone: $data['phone'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'position' => $this->position,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]; }
}