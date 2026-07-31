<?php

namespace App\Domain\SchoolManagement\Teacher\DTOs;

class TeacherDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $subject,
        public readonly mixed $phone,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            subject: $data['subject'] ?? null,
            phone: $data['phone'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'subject' => $this->subject,
            'phone' => $this->phone,
        ]; }
}