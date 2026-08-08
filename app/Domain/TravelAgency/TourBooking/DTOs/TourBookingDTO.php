<?php

namespace App\Domain\TravelAgency\TourBooking\DTOs;

class TourBookingDTO
{
    public function __construct(
        public readonly mixed $client_id,
        public readonly mixed $tour_package_id,
        public readonly mixed $booking_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            client_id: $data['client_id'] ?? null,
            tour_package_id: $data['tour_package_id'] ?? null,
            booking_date: $data['booking_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'client_id' => $this->client_id,
            'tour_package_id' => $this->tour_package_id,
            'booking_date' => $this->booking_date,
        ]; }
}