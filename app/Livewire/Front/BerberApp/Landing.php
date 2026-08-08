<?php

namespace App\Livewire\Front\BerberApp;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\BerberApp\Barber;
use App\Models\BerberApp\Service;
use App\Models\BerberApp\Booking;
use App\Models\BerberApp\BarberException;
use App\Models\BerberApp\BarberWorkingHour;
use Carbon\Carbon;

#[Title('The Station Barbers')]
class Landing extends Component
{
    // Booking Flow State
    public $showBookingModal = false;
    public $step = 1; // 1: Service/Barber, 2: Date/Time, 3: Info

    public $selectedServiceId;
    public $selectedBarberId;
    public $selectedDate;
    public $selectedTime;

    public $customerName;
    public $customerPhone;
    public $allowNotifications = true;

    protected $listeners = ['fcm-token-received' => 'setFcmToken'];
    public $fcmToken;

    public function setFcmToken($token)
    {
        $this->fcmToken = $token;
    }

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function selectService($id)
    {
        $this->selectedServiceId = $id;
        $this->step = 2;

        // Only open modal AFTER data is potentially ready (Livewire will handle the state)
        $this->showBookingModal = true;
    }

    public function updatedSelectedDate()
    {
        $this->selectedTime = null;
    }

    public function getAvailableSlotsProperty()
    {
        if (!$this->selectedDate || !$this->selectedServiceId) return [];

        $selectedService = Service::find($this->selectedServiceId);
        if (!$selectedService) return [];
        $duration = (int) ($selectedService->duration_minutes ?: 30);

        $slots = [];

        // 1. Get Day of Week (0-6)
        $date = Carbon::parse($this->selectedDate);
        $dayOfWeek = $date->dayOfWeek;

        // 2. Load Active Barbers and their working hours for this day
        $activeBarbers = Barber::where('active', true)
            ->with(['workingHours' => fn($q) => $q->where('day_of_week', $dayOfWeek)])
            ->get();

        if ($activeBarbers->isEmpty()) return [];

        $barberIds = $this->selectedBarberId ? [$this->selectedBarberId] : $activeBarbers->pluck('id')->toArray();

        // 3. Determine overall start/end for the day based on active barbers
        $dayStart = null;
        $dayEnd = null;

        foreach ($activeBarbers as $barber) {
            $wh = $barber->workingHours->first();
            $bStart = $wh ? $wh->start_time : '09:00';
            $bEnd = $wh ? $wh->end_time : '19:00';
            $bIsOff = $wh ? $wh->is_off : ($dayOfWeek === 0);

            if ($bIsOff) continue;

            if ($dayStart === null || $bStart < $dayStart) $dayStart = $bStart;
            if ($dayEnd === null || $bEnd > $dayEnd) $dayEnd = $bEnd;
        }

        if (!$dayStart || !$dayEnd) {
            $dayStart = '09:00';
            $dayEnd = '19:00';
        }

        $start = Carbon::parse($this->selectedDate . ' ' . $dayStart);
        $end = Carbon::parse($this->selectedDate . ' ' . $dayEnd);

        // Past slots handling
        if ($start->isToday()) {
            $now = now();
            if ($now->gt($end)) return [];
            if ($start->lt($now)) {
                $start = $now->toMutable()->addMinutes(10);
                $minutes = (int) $start->format('i');
                if ($minutes <= 30) {
                    $start->minute(30)->second(0);
                } else {
                    $start->addHour()->minute(0)->second(0);
                }
            }
        }

        $start = $start->toMutable();
        $end = Carbon::parse($this->selectedDate . ' ' . $dayEnd)->toMutable();

        // 4. Fetch Bookings and Exceptions
        $bookings = Booking::whereIn('barber_id', $barberIds)
            ->whereDate('appointment_datetime', $this->selectedDate)
            ->where('status', '!=', 'cancelled')
            ->with('service')
            ->get();

        $exceptions = BarberException::whereIn('barber_id', $barberIds)
            ->where(function($q) {
                $q->whereDate('start_datetime', $this->selectedDate)
                  ->orWhereDate('end_datetime', $this->selectedDate);
            })
            ->get();

        // 5. Generate slots with Safety Break
        $safety_limit = 100;
        while ($start->copy()->addMinutes($duration) <= $end && $safety_limit > 0) {
            $safety_limit--;
            $slotStart = $start->copy();
            $slotEnd = $start->copy()->addMinutes($duration);
            $isSlotAvailable = false;

            foreach ($activeBarbers as $barber) {
                if ($this->selectedBarberId && $this->selectedBarberId != $barber->id) continue;

                $wh = $barber->workingHours->first();
                $bStartTime = $wh ? $wh->start_time : '09:00';
                $bEndTime = $wh ? $wh->end_time : '19:00';
                $bIsOff = $wh ? $wh->is_off : ($dayOfWeek === 0);

                if ($bIsOff) continue;

                $bStartBound = Carbon::parse($this->selectedDate . ' ' . $bStartTime);
                $bEndBound = Carbon::parse($this->selectedDate . ' ' . $bEndTime);
                if ($slotStart < $bStartBound || $slotEnd > $bEndBound) continue;

                // Check Bookings
                $hasBookingConflict = $bookings->where('barber_id', $barber->id)->some(function ($b) use ($slotStart, $slotEnd) {
                    $bStart = $b->appointment_datetime;
                    $bEnd = $b->appointment_datetime->copy()->addMinutes((int)($b->service->duration_minutes ?? 30));
                    return $slotStart < $bEnd && $slotEnd > $bStart;
                });

                if ($hasBookingConflict) continue;

                // Check Exceptions
                $hasExceptionConflict = $exceptions->where('barber_id', $barber->id)->some(function ($e) use ($slotStart, $slotEnd) {
                    return $slotStart < $e->end_datetime && $slotEnd > $e->start_datetime;
                });

                if ($hasExceptionConflict) continue;

                $isSlotAvailable = true;
                break;
            }

            if ($isSlotAvailable) {
                $slots[] = $slotStart->format('H:i');
            }

            $start->addMinutes(30);
        }

        return $slots;
    }

    public function confirmTime($time)
    {
        $this->selectedTime = $time;
        $this->step = 3;
    }

    public function submitBooking(\App\Domain\BerberApp\Booking\Actions\CreateBookingAction $action)
    {
        $this->validate([
            'customerName' => 'required|string|min:3',
            'customerPhone' => 'required|string|min:8',
            'selectedServiceId' => 'required',
            'selectedDate' => 'required',
            'selectedTime' => 'required',
        ]);

        $barberId = $this->selectedBarberId;
        if (!$barberId) {
            $barberId = Barber::where('active', true)->first()->id;
        }

        $dto = \App\Domain\BerberApp\Booking\DTOs\BookingDTO::fromArray([
            'barber_id' => $barberId,
            'service_id' => $this->selectedServiceId,
            'customer_name' => $this->customerName,
            'customer_phone' => $this->customerPhone,
            'appointment_datetime' => Carbon::parse($this->selectedDate . ' ' . $this->selectedTime)->toDateTimeString(),
            'status' => 'pending',
            'reminder_enabled' => $this->allowNotifications,
            'reminder_minutes' => 30,
            'fcm_token' => $this->fcmToken,
        ]);

        $action->execute($dto);

        $this->step = 4; // Success
    }

    public function resetBooking()
    {
        $this->reset(['showBookingModal', 'step', 'selectedServiceId', 'selectedBarberId', 'selectedTime', 'customerName', 'customerPhone']);
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.front.berber-app.landing', [
            'barbers' => Barber::all(), // Removed active filter for initial display
            'services' => Service::all(), // Removed active filter for initial display
            'selectedService' => $this->selectedServiceId ? Service::find($this->selectedServiceId) : null,
            'selectedBarber' => $this->selectedBarberId ? Barber::find($this->selectedBarberId) : null,
        ])->layout('components.layouts.front');
    }
}
