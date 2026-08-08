<?php

namespace App\Domain\HumanResources\Department\DTOs;

class DepartmentDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $description,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'description' => $this->description,
        ]; }
}