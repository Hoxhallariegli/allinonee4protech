<?php

namespace App\Domain\SchoolManagement\Timetable\DTOs;

class TimetableDTO
{
    public function __construct(
        public readonly mixed $school_class_id,
        public readonly mixed $subject_id,
        public readonly mixed $teacher_id,
        public readonly mixed $day,
        public readonly mixed $start_time,
        public readonly mixed $end_time,
    ) {}
    public static function fromArray(array $data): self { return new self(
            school_class_id: $data['school_class_id'] ?? null,
            subject_id: $data['subject_id'] ?? null,
            teacher_id: $data['teacher_id'] ?? null,
            day: $data['day'] ?? null,
            start_time: $data['start_time'] ?? null,
            end_time: $data['end_time'] ?? null,
        ); }
    public function toArray(): array { return [
            'school_class_id' => $this->school_class_id,
            'subject_id' => $this->subject_id,
            'teacher_id' => $this->teacher_id,
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]; }
}