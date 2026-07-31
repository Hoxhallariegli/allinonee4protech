<?php

namespace App\Domain\SchoolManagement\Student\DTOs;

class StudentDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $guardian_id,
        public readonly mixed $class_id,
        public readonly mixed $birth_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            guardian_id: $data['guardian_id'] ?? null,
            class_id: $data['class_id'] ?? null,
            birth_date: $data['birth_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'guardian_id' => $this->guardian_id,
            'class_id' => $this->class_id,
            'birth_date' => $this->birth_date,
        ]; }
}