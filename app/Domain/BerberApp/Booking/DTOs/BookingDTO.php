<?php

namespace App\Domain\BerberApp\Booking\DTOs;

class BookingDTO
{
    public function __construct(
        public readonly mixed $barber_id,
        public readonly mixed $service_id,
        public readonly mixed $customer_name,
        public readonly mixed $customer_phone,
        public readonly mixed $appointment_datetime,
        public readonly mixed $status,
        public readonly mixed $reminder_enabled,
        public readonly mixed $reminder_minutes,
        public readonly mixed $cancel_reason = null,
    ) {}
    public static function fromArray(array $data): self { return new self(
            barber_id: $data['barber_id'] ?? null,
            service_id: $data['service_id'] ?? null,
            customer_name: $data['customer_name'] ?? null,
            customer_phone: $data['customer_phone'] ?? null,
            appointment_datetime: $data['appointment_datetime'] ?? null,
            status: $data['status'] ?? null,
            reminder_enabled: $data['reminder_enabled'] ?? null,
            reminder_minutes: $data['reminder_minutes'] ?? null,
            cancel_reason: $data['cancel_reason'] ?? null,
        ); }
    public function toArray(): array { return [
            'barber_id' => $this->barber_id,
            'service_id' => $this->service_id,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'appointment_datetime' => $this->appointment_datetime,
            'status' => $this->status,
            'reminder_enabled' => $this->reminder_enabled,
            'reminder_minutes' => $this->reminder_minutes,
            'cancel_reason' => $this->cancel_reason,
        ]; }
}
