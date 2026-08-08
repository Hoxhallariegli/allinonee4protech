<?php

namespace App\Domain\HumanResources\Employee\DTOs;

class EmployeeDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $email,
        public readonly mixed $phone,
        public readonly mixed $department_id,
        public readonly mixed $hire_date,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            department_id: $data['department_id'] ?? null,
            hire_date: $data['hire_date'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department_id' => $this->department_id,
            'hire_date' => $this->hire_date,
            'photo' => $this->photo,
        ]; }
}