<?php

namespace App\Domain\BerberApp\Booking\Actions;

use App\Models\BerberApp\Booking;
use App\Models\BerberApp\DeviceToken;
use App\Models\User;
use App\Domain\BerberApp\Booking\DTOs\BookingDTO;
use App\Models\AuditTrail;
use App\Services\FirebaseService;

class CreateBookingAction
{
    public function __construct(
        protected FirebaseService $firebaseService
    ) {}

    public function execute(BookingDTO $dto): Booking
    {
        $item = Booking::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Bookings');

        // Notify Barber/Admins
        $this->notifyStaff($item);

        return $item;
    }

    protected function notifyStaff(Booking $booking)
    {
        $barber = $booking->barber;
        $title = "Rezervim i Ri!";
        $body = "Klienti {$booking->customer_name} rezervoi në orën " . $booking->appointment_datetime->format('d/m H:i');

        // 1. Notify specific barber if they have user_id and tokens
        if ($barber && $barber->user_id) {
            $tokens = DeviceToken::where('user_id', $barber->user_id)->pluck('fcm_token')->toArray();
            foreach ($tokens as $token) {
                $this->firebaseService->sendNotification($title, $body, $token);
            }
        }

        // 2. Notify all Admins who have permission
        $admins = User::all()->filter(fn($u) => $u->can('view_bookings'));

        foreach ($admins as $admin) {
            if ($barber && $admin->id === $barber->user_id) continue;

            $tokens = DeviceToken::where('user_id', $admin->id)->pluck('fcm_token')->toArray();
            foreach ($tokens as $token) {
                $this->firebaseService->sendNotification($title, $body, $token);
            }
        }
    }
}
