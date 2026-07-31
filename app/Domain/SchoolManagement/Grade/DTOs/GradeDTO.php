<?php

namespace App\Domain\SchoolManagement\Grade\DTOs;

class GradeDTO
{
    public function __construct(
        public readonly mixed $student_id,
        public readonly mixed $exam_id,
        public readonly mixed $score,
    ) {}
    public static function fromArray(array $data): self { return new self(
            student_id: $data['student_id'] ?? null,
            exam_id: $data['exam_id'] ?? null,
            score: $data['score'] ?? null,
        ); }
    public function toArray(): array { return [
            'student_id' => $this->student_id,
            'exam_id' => $this->exam_id,
            'score' => $this->score,
        ]; }
}