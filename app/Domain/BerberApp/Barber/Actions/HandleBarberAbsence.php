<?php

namespace App\Domain\BerberApp\Barber\Actions;

use App\Models\BerberApp\Barber;
use App\Models\BerberApp\BarberException;
use App\Models\BerberApp\Booking;
use App\Models\BerberApp\Reminder;
use App\Services\FirebaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HandleBarberAbsence
{
    public function __construct(
        protected FirebaseService $firebaseService
    ) {}

    /**
     * Handles barber absence (emergency or planned).
     *
     * @param int $barberId
     * @param string $start (Y-m-d H:i)
     * @param string $end (Y-m-d H:i)
     * @param string $type (emergency|vacation)
     * @param string|null $reason
     * @return void
     */
    public function execute(int $barberId, string $start, string $end, string $type = 'emergency', ?string $reason = null)
    {
        $barber = Barber::findOrFail($barberId);
        $startTime = Carbon::parse($start);
        $endTime = Carbon::parse($end);

        // 1. Create the exception
        BarberException::create([
            'barber_id' => $barberId,
            'start_datetime' => $startTime,
            'end_datetime' => $endTime,
            'type' => $type,
            'reason' => $reason,
        ]);

        // 2. Find affected bookings using overlap logic
        $bookings = Booking::where('barber_id', $barberId)
            ->whereIn('status', ['pending', 'confirmed', 'awaiting_response'])
            ->join('ba_services', 'ba_bookings.service_id', '=', 'ba_services.id')
            ->where(function ($query) use ($startTime, $endTime) {
                // Conflict logic: Booking overlaps with Absence if:
                // BookingStart < AbsenceEnd AND BookingEnd > AbsenceStart
                $query->where('appointment_datetime', '<', $endTime->toDateTimeString())
                      ->whereRaw('DATE_ADD(appointment_datetime, INTERVAL ba_services.duration_minutes MINUTE) > ?', [$startTime->toDateTimeString()]);
            })
            ->select('ba_bookings.*')
            ->get();

        foreach ($bookings as $booking) {
            // Cancel the booking - The BookingObserver will automatically handle:
            // 1. Cancelling reminders
            // 2. Notifying the customer via Firebase
            $booking->update([
                'status' => 'cancelled',
                'cancel_reason' => "Absenca e berberit ({$type}): " . ($reason ?? 'Emergjencë'),
            ]);
        }

        Log::info("Handled absence for barber {$barber->name}. Affected bookings: " . $bookings->count());
    }
}
