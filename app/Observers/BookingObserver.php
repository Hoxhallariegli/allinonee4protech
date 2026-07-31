<?php

namespace App\Observers;

use App\Models\BerberApp\Booking;
use App\Models\BerberApp\DeviceToken;
use App\Models\BerberApp\Reminder;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Log;

class BookingObserver
{
    public function __construct(protected FirebaseService $firebaseService) {}

    public function updated(Booking $booking): void
    {
        // Handle Cancellation
        if ($booking->isDirty('status') && $booking->status === 'cancelled') {
            Log::info("🚫 Booking #{$booking->id} status changed to cancelled. Notifying customer...");

            // 1. Cancel pending reminders
            Reminder::where('booking_id', $booking->id)
                ->where('status', 'pending')
                ->update(['status' => 'cancelled']);

            // 2. Notify Customer
            $title = "Ndryshim në Rezervim";
            $message = "Përshëndetje {$booking->customer_name}. Rezervimi juaj për në orën " . $booking->appointment_datetime->format('H:i') . " u anullua. Ju lutem na kontaktoni për më shumë informacion ose zgjidhni një orar tjetër.";

            $tokens = DeviceToken::where('booking_id', $booking->id)->pluck('fcm_token')->toArray();
            foreach ($tokens as $token) {
                $this->firebaseService->sendNotification($title, $message, $token);
            }
        }
    }
}
