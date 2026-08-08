<?php

namespace App\Domain\FleetManagement\Shipment\DTOs;

class ShipmentDTO
{
    public function __construct(
        public readonly mixed $vehicle_id,
        public readonly mixed $driver_id,
        public readonly mixed $origin,
        public readonly mixed $destination,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            vehicle_id: $data['vehicle_id'] ?? null,
            driver_id: $data['driver_id'] ?? null,
            origin: $data['origin'] ?? null,
            destination: $data['destination'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'status' => $this->status,
        ]; }
}