<?php

namespace App\Domain\BerberApp\Booking\Actions;

use App\Models\BerberApp\Booking;
use App\Models\BerberApp\DeviceToken;
use App\Models\User;
use App\Domain\BerberApp\Booking\DTOs\BookingDTO;
use App\Models\AuditTrail;
use App\Services\FirebaseService;
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

        // 1. Notify Barber/Admins (Staff)
        $this->notifyStaff($item);

        // 2. Notify Customer Immediately (Confirmation)
        if ($item->reminder_enabled) {
            $this->notifyCustomerImmediate($item);

            // 3. Schedule Reminder (30 min before)
            \App\Models\BerberApp\Reminder::create([
                'booking_id' => $item->id,
                'send_at' => $item->appointment_datetime->copy()->subMinutes(30),
                'type' => 'appointment_reminder',
                'status' => 'pending'
            ]);

            Log::info("📅 Scheduled 30min reminder for Booking #{$item->id}");
        }

        return $item;
    }

    protected function notifyCustomerImmediate(Booking $booking)
    {
        $title = "Rezervimi u Krye!";
        $body = "Përshëndetje {$booking->customer_name}. E morëm rezervimin tuaj për në orën " . $booking->appointment_datetime->format('H:i') . ". Do t'ju njoftojmë përsëri 30 min përpara takimit.";

        $tokens = DeviceToken::where('booking_id', $booking->id)->pluck('fcm_token')->toArray();

        Log::info("Attempting immediate confirmation to customer: {$booking->customer_name}. Found " . count($tokens) . " tokens.");

        foreach ($tokens as $token) {
            $this->firebaseService->sendNotification($title, $body, $token);
        }
    }

    protected function notifyStaff(Booking $booking)
    {
        $barber = $booking->barber;
        $title = "Rezervim i Ri!";
        $body = "Klienti {$booking->customer_name} rezervoi në orën " . $booking->appointment_datetime->format('d/m H:i');

        Log::info("🚀 Notification Flow Started for Booking #{$booking->id}");

        // 1. Notify specific barber if they have user_id and tokens
        if ($barber && $barber->user_id) {
            $enabled = \App\Models\NotificationSetting::where('user_id', $barber->user_id)
                ->where('module', 'BerberApp')
                ->where('event_type', 'booking_created')
                ->where('enabled', true)
                ->exists();

            // Default to true if no setting exists
            if (\App\Models\NotificationSetting::where('user_id', $barber->user_id)->where('module', 'BerberApp')->where('event_type', 'booking_created')->doesntExist()) {
                $enabled = true;
            }

            if ($enabled) {
                $tokens = DeviceToken::where('user_id', $barber->user_id)->pluck('fcm_token')->toArray();
                Log::info("Found " . count($tokens) . " tokens for Barber: {$barber->name}");
                foreach ($tokens as $token) {
                    $this->firebaseService->sendNotification($title, $body, $token);
                }
            } else {
                Log::info("Barber {$barber->name} has DISABLED booking notifications.");
            }
        }

        // 2. Notify all Admins who have permission
        $admins = User::all()->filter(fn($u) => $u->can('view_bookings'));
        Log::info("Found " . count($admins) . " potential Admins to notify.");

        foreach ($admins as $admin) {
            if ($barber && $admin->id === $barber->user_id) continue;

            $enabled = \App\Models\NotificationSetting::where('user_id', $admin->id)
                ->where('module', 'BerberApp')
                ->where('event_type', 'booking_created')
                ->where('enabled', true)
                ->exists();

            if (\App\Models\NotificationSetting::where('user_id', $admin->id)->where('module', 'BerberApp')->where('event_type', 'booking_created')->doesntExist()) {
                $enabled = true;
            }

            if ($enabled) {
                $tokens = DeviceToken::where('user_id', $admin->id)->pluck('fcm_token')->toArray();
                Log::info("Found " . count($tokens) . " tokens for Admin: {$admin->name}");
                foreach ($tokens as $token) {
                    $this->firebaseService->sendNotification($title, $body, $token);
                }
            }
        }
    }
}
