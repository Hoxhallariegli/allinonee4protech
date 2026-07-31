<?php

namespace App\Domain\BerberApp\Reminder\DTOs;

class ReminderDTO
{
    public function __construct(
        public readonly mixed $booking_id,
        public readonly mixed $send_at,
        public readonly mixed $sent_at,
        public readonly mixed $type,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            booking_id: $data['booking_id'] ?? null,
            send_at: $data['send_at'] ?? null,
            sent_at: $data['sent_at'] ?? null,
            type: $data['type'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'booking_id' => $this->booking_id,
            'send_at' => $this->send_at,
            'sent_at' => $this->sent_at,
            'type' => $this->type,
            'status' => $this->status,
        ]; }
}