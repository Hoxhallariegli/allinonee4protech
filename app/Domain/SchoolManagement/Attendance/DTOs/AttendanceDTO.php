<?php

namespace App\Domain\SchoolManagement\Attendance\DTOs;

class AttendanceDTO
{
    public function __construct(
        public readonly mixed $student_id,
        public readonly mixed $class_id,
        public readonly mixed $date,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            student_id: $data['student_id'] ?? null,
            class_id: $data['class_id'] ?? null,
            date: $data['date'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'date' => $this->date,
            'status' => $this->status,
        ]; }
}