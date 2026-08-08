<?php

namespace App\Domain\WarehouseManagement\Employee\DTOs;

class EmployeeDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $position,
        public readonly mixed $salary,
        public readonly mixed $hire_date,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            position: $data['position'] ?? null,
            salary: $data['salary'] ?? null,
            hire_date: $data['hire_date'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'position' => $this->position,
            'salary' => $this->salary,
            'hire_date' => $this->hire_date,
            'photo' => $this->photo,
        ]; }
}