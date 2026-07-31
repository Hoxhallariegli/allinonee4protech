<?php

namespace App\Domain\SchoolManagement\Exam\DTOs;

class ExamDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $class_id,
        public readonly mixed $exam_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            class_id: $data['class_id'] ?? null,
            exam_date: $data['exam_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'class_id' => $this->class_id,
            'exam_date' => $this->exam_date,
        ]; }
}