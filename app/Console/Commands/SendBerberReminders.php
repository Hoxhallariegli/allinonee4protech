<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BerberApp\Reminder;
use App\Services\FirebaseService;
use Carbon\Carbon;

class SendBerberReminders extends Command
{
    protected $signature = 'berber:send-reminders';
    protected $description = 'Dërgon njoftimet push për rezervimet 30 min para';

    public function __construct(
        protected FirebaseService $firebaseService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();
        $reminders = Reminder::where('status', 'pending')
            ->where('send_at', '<=', $now)
            ->with(['booking.barber', 'booking.service'])
            ->get();

        foreach ($reminders as $reminder) {
            $booking = $reminder->booking;

            if (!$booking || $booking->status === 'cancelled') {
                $reminder->update(['status' => $booking ? 'cancelled' : 'failed']);
                continue;
            }

            $title = "Kujtesë për Takimin";
            $body = "Përshëndetje {$booking->customer_name}! Mos harroni takimin tuaj në " . Carbon::parse($booking->appointment_datetime)->format('H:i');

            // Try to find device tokens for this booking
            $tokens = \App\Models\BerberApp\DeviceToken::where('booking_id', $booking->id)->pluck('fcm_token')->toArray();

            $sent = false;
            if (!empty($tokens)) {
                foreach ($tokens as $token) {
                    if ($this->firebaseService->sendNotification($title, $body, $token)) {
                        $sent = true;
                    }
                }
            } else {
                // Fallback to topic
                $sent = $this->firebaseService->sendNotification($title, $body, "booking_{$booking->id}");
            }

            if ($sent) {
                $reminder->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);

                // Also notify the Barber if they have it enabled
                $this->notifyBarberAboutReminder($booking);
            }
        }

        $this->info("U dërguan " . $reminders->count() . " njoftime.");
    }

    protected function notifyBarberAboutReminder($booking)
    {
        if (!$booking->barber || !$booking->barber->user_id) return;

        $enabled = \App\Models\NotificationSetting::where('user_id', $booking->barber->user_id)
            ->where('module', 'BerberApp')
            ->where('event_type', 'reminder')
            ->where('enabled', true)
            ->exists();

        if (NotificationSetting::where('user_id', $booking->barber->user_id)->where('module', 'BerberApp')->where('event_type', 'reminder')->doesntExist()) {
            $enabled = true;
        }

        if (!$enabled) return;

        $title = "Kujtesë: Klienti po vjen";
        $body = "Klienti {$booking->customer_name} ka takimin në orën " . $booking->appointment_datetime->format('H:i');

        $this->firebaseService->sendNotification($title, $body, "user_{$booking->barber->user_id}");
    }
}
