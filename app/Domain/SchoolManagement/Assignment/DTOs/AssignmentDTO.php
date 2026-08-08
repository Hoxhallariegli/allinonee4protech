<?php

namespace App\Domain\SchoolManagement\Assignment\DTOs;

class AssignmentDTO
{
    public function __construct(
        public readonly mixed $school_class_id,
        public readonly mixed $subject_id,
        public readonly mixed $title,
        public readonly mixed $description,
        public readonly mixed $due_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            school_class_id: $data['school_class_id'] ?? null,
            subject_id: $data['subject_id'] ?? null,
            title: $data['title'] ?? null,
            description: $data['description'] ?? null,
            due_date: $data['due_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'school_class_id' => $this->school_class_id,
            'subject_id' => $this->subject_id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
        ]; }
}