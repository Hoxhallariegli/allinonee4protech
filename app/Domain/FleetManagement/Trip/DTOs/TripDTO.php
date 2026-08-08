<?php

namespace App\Domain\FleetManagement\Trip\DTOs;

class TripDTO
{
    public function __construct(
        public readonly mixed $vehicle_id,
        public readonly mixed $driver_id,
        public readonly mixed $start_location,
        public readonly mixed $destination,
        public readonly mixed $distance,
    ) {}
    public static function fromArray(array $data): self { return new self(
            vehicle_id: $data['vehicle_id'] ?? null,
            driver_id: $data['driver_id'] ?? null,
            start_location: $data['start_location'] ?? null,
            destination: $data['destination'] ?? null,
            distance: $data['distance'] ?? null,
        ); }
    public function toArray(): array { return [
            'vehicle_id' => $this->vehicle_id,
            'driver_id' => $this->driver_id,
            'start_location' => $this->start_location,
            'destination' => $this->destination,
            'distance' => $this->distance,
        ]; }
}