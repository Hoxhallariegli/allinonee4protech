<?php

namespace App\Domain\Berber\Booking\Actions;

use App\Models\Berber\Booking;
use App\Models\Berber\Barber;
use App\Domain\Berber\Booking\DTOs\BookingDTO;
use App\Services\FirebaseService;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Log;

class CreateBookingAction
{
    public function __construct(
        protected FirebaseService $firebaseService
    ) {}

    public function execute(BookingDTO $dto): Booking
    {
        $item = Booking::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Bookings');

        // 1. Notify Barber
        $this->notifyBarber($item);

        // 2. Schedule Reminder (handled by a background job or a dedicated table)
        // If the user wants a 'reminders' table, we can insert there.
        if ($item->reminder_enabled) {
            $this->scheduleReminder($item);
        }

        return $item;
    }

    protected function notifyBarber(Booking $booking)
    {
        $barber = $booking->barber;
        if (!$barber) return;

        // In a real app, you'd get the Barber's FCM tokens from b_device_tokens
        // For now, I'll log it and attempt to send to a topic named 'barber_{id}'
        $title = "Rezervim i Ri!";
        $body = "Klienti {$booking->customer_name} rezervoi në {$booking->appointment_datetime->format('d/m/Y H:i')}";

        $this->firebaseService->sendNotification($title, $body, "barber_{$barber->id}");
        Log::info("Notification sent to barber {$barber->id} for booking {$booking->id}");
    }

    protected function scheduleReminder(Booking $booking)
    {
        // This could insert into b_reminders table
        // Or dispatch a delayed job.
        // The user mentioned a "reminders table".
        // \App\Models\Berber\Reminder::create([...]);
    }
}
