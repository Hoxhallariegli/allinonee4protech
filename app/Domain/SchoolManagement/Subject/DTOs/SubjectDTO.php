<?php

namespace App\Domain\SchoolManagement\Subject\DTOs;

class SubjectDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $code,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            code: $data['code'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'code' => $this->code,
        ]; }
}