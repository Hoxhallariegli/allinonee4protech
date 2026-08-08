<?php

namespace App\Domain\EventManagement\Booking\DTOs;

class BookingDTO
{
    public function __construct(
        public readonly mixed $event_id,
        public readonly mixed $attendee_id,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            event_id: $data['event_id'] ?? null,
            attendee_id: $data['attendee_id'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'event_id' => $this->event_id,
            'attendee_id' => $this->attendee_id,
            'status' => $this->status,
        ]; }
}