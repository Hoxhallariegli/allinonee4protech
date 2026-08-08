<?php

namespace App\Domain\GymManagement\Member\DTOs;

class MemberDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $email,
        public readonly mixed $phone,
        public readonly mixed $membership_plan_id,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            membership_plan_id: $data['membership_plan_id'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'membership_plan_id' => $this->membership_plan_id,
            'photo' => $this->photo,
        ]; }
}