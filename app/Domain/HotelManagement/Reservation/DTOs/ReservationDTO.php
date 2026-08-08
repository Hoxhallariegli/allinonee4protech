<?php

namespace App\Domain\HotelManagement\Reservation\DTOs;

class ReservationDTO
{
    public function __construct(
        public readonly mixed $guest_id,
        public readonly mixed $room_id,
        public readonly mixed $check_in,
        public readonly mixed $check_out,
        public readonly mixed $total_price,
    ) {}
    public static function fromArray(array $data): self { return new self(
            guest_id: $data['guest_id'] ?? null,
            room_id: $data['room_id'] ?? null,
            check_in: $data['check_in'] ?? null,
            check_out: $data['check_out'] ?? null,
            total_price: $data['total_price'] ?? null,
        ); }
    public function toArray(): array { return [
            'guest_id' => $this->guest_id,
            'room_id' => $this->room_id,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'total_price' => $this->total_price,
        ]; }
}