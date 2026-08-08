<?php

namespace App\Domain\TravelAgency\FlightTicket\DTOs;

class FlightTicketDTO
{
    public function __construct(
        public readonly mixed $client_id,
        public readonly mixed $flight_number,
        public readonly mixed $departure_date,
        public readonly mixed $price,
    ) {}
    public static function fromArray(array $data): self { return new self(
            client_id: $data['client_id'] ?? null,
            flight_number: $data['flight_number'] ?? null,
            departure_date: $data['departure_date'] ?? null,
            price: $data['price'] ?? null,
        ); }
    public function toArray(): array { return [
            'client_id' => $this->client_id,
            'flight_number' => $this->flight_number,
            'departure_date' => $this->departure_date,
            'price' => $this->price,
        ]; }
}