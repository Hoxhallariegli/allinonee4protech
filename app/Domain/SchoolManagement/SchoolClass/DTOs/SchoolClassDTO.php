<?php

namespace App\Domain\SchoolManagement\SchoolClass\DTOs;

class SchoolClassDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $teacher_id,
        public readonly mixed $capacity,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            teacher_id: $data['teacher_id'] ?? null,
            capacity: $data['capacity'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'teacher_id' => $this->teacher_id,
            'capacity' => $this->capacity,
        ]; }
}