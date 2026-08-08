<?php

namespace App\Domain\BerberApp\Booking\DTOs;

class BookingDTO
{
    public function __construct(
        public readonly mixed $customer_id,
        public readonly mixed $barber_id,
        public readonly mixed $service_id,
        public readonly mixed $appointment_datetime,
    ) {}
    public static function fromArray(array $data): self { return new self(
            customer_id: $data['customer_id'] ?? null,
            barber_id: $data['barber_id'] ?? null,
            service_id: $data['service_id'] ?? null,
            appointment_datetime: $data['appointment_datetime'] ?? null,
        ); }
    public function toArray(): array { return [
            'customer_id' => $this->customer_id,
            'barber_id' => $this->barber_id,
            'service_id' => $this->service_id,
            'appointment_datetime' => $this->appointment_datetime,
        ]; }
}