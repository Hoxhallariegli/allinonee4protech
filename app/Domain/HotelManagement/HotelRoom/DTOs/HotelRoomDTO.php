<?php

namespace App\Domain\HotelManagement\HotelRoom\DTOs;

class HotelRoomDTO
{
    public function __construct(
        public readonly mixed $room_number,
        public readonly mixed $room_type_id,
        public readonly mixed $status,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            room_number: $data['room_number'] ?? null,
            room_type_id: $data['room_type_id'] ?? null,
            status: $data['status'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'room_number' => $this->room_number,
            'room_type_id' => $this->room_type_id,
            'status' => $this->status,
            'photo' => $this->photo,
        ]; }
}