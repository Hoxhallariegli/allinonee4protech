<?php

namespace App\Livewire\Admin\BerberApp\Bookings;

use App\Models\BerberApp\Booking;
use App\Domain\BerberApp\Booking\DTOs\BookingDTO;
use App\Domain\BerberApp\Booking\Actions\CreateBookingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

use App\Models\BerberApp\Barber;
use App\Models\BerberApp\Service;
use App\Models\BerberApp\BarberException;
use Carbon\Carbon;

class QuickCreate extends Component
{
    use WithPagination;
    public $barber_id = '';
    public $service_id = '';
    public $customer_name = '';
    public $customer_phone = '';
    public $appointment_datetime = '';
    public $status = 'pending';
    public $reminder_enabled = true;
    public $reminder_minutes = 30;

    // Slot Selection
    public $selected_date;
    public $selected_time;

    public function mount($appointment_datetime = null)
    {
        $this->selected_date = now()->format('Y-m-d');

        if ($appointment_datetime) {
            $dt = Carbon::parse($appointment_datetime);
            $this->appointment_datetime = $dt->toDateTimeString();
            $this->selected_date = $dt->format('Y-m-d');
            $this->selected_time = $dt->format('H:i');
        }
    }

    public function updatedSelectedDate()
    {
        $this->selected_time = null;
    }

    public function selectTime($time)
    {
        $this->selected_time = $time;
        $this->appointment_datetime = Carbon::parse($this->selected_date . ' ' . $time)->toDateTimeString();
    }

    public function getAvailableSlotsProperty()
    {
        if (!$this->selected_date || !$this->service_id) return [];

        $selectedService = Service::find($this->service_id);
        if (!$selectedService) return [];
        $newDuration = $selectedService->duration_minutes;

        $slots = [];
        $start = Carbon::parse($this->selected_date . ' 09:00');

        // Ensure we don't show past slots for today
        if ($start->isToday()) {
            $now = now();
            if ($now->minute > 0 && $now->minute <= 30) {
                $start->minute(30);
            } elseif ($now->minute > 30) {
                $start->addHour()->minute(0);
            }
        }

        $end = Carbon::parse($this->selected_date . ' 19:00');

        $activeBarbers = Barber::where('active', true)->get();

        while ($start->copy()->addMinutes($newDuration) <= $end) {
            $slotStart = $start->copy();
            $slotEnd = $start->copy()->addMinutes($newDuration);
            $timeString = $slotStart->format('H:i');

            $barbersToCheck = $this->barber_id
                ? $activeBarbers->where('id', $this->barber_id)
                : $activeBarbers;

            $isAvailable = false;

            foreach ($barbersToCheck as $barber) {
                $hasBookingConflict = Booking::where('barber_id', $barber->id)
                    ->where('status', '!=', 'cancelled')
                    ->join('ba_services', 'ba_bookings.service_id', '=', 'ba_services.id')
                    ->where(function ($query) use ($slotStart, $slotEnd) {
                        $query->where('appointment_datetime', '<', $slotEnd->toDateTimeString())
                              ->whereRaw('datetime(appointment_datetime, "+" || ba_services.duration_minutes || " minutes") > ?', [$slotStart->toDateTimeString()]);
                    })
                    ->exists();

                if ($hasBookingConflict) continue;

                $hasExceptionConflict = BarberException::where('barber_id', $barber->id)
                    ->where(function ($query) use ($slotStart, $slotEnd) {
                        $query->where('start_datetime', '<', $slotEnd->toDateTimeString())
                              ->where('end_datetime', '>', $slotStart->toDateTimeString());
                    })
                    ->exists();

                if (!$hasExceptionConflict) {
                    $isAvailable = true;
                    break;
                }
            }

            if ($isAvailable) {
                $slots[] = $timeString;
            }

            $start->addMinutes(30);
        }

        return $slots;
    }

    #[On('barber-created')]
    public function refreshBarbers($id) { $this->barber_id = $id; $this->updatedBarberId($id); }

    #[On('service-created')]
    public function refreshServices($id) { $this->service_id = $id; $this->updatedServiceId($id); }

    public function updatedBarberId($value)
    {
        if (!$value) return;
        $related = \App\Models\BerberApp\Barber::find($value);
        if (!$related) return;
        if (isset($related->service_id)) { $this->service_id = $related->service_id; }
    }

    public function updatedServiceId($value)
    {
        if (!$value) return;
        $related = \App\Models\BerberApp\Service::find($value);
        if (!$related) return;
        if (isset($related->barber_id)) { $this->barber_id = $related->barber_id; }
    }

    protected function getbarbersList() {
        return \App\Models\BerberApp\Barber::pluck('name', 'id')->toArray();
    }

    protected function getservicesList() {
        return \App\Models\BerberApp\Service::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.berber-app.bookings.quick-create', [
            'barbers' => $this->getbarbersList(),
            'services' => $this->getservicesList(),
        ]); }

    public function store(CreateBookingAction $action)
    {
        $this->validate();
        $dto = BookingDTO::fromArray([
            'barber_id' => $this->barber_id ?: Barber::where('active', true)->first()->id,
            'service_id' => $this->service_id,
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'appointment_datetime' => $this->appointment_datetime,
            'status' => $this->status ?: 'pending',
            'reminder_enabled' => $this->reminder_enabled,
            'reminder_minutes' => $this->reminder_minutes,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('booking-created', id: $item->id);
        $this->dispatch('toast', message: __('berber-app/bookings.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->customer_name . ' - ' . Carbon::parse($item->appointment_datetime)->format('d/m H:i'));
        $this->reset(['barber_id', 'service_id', 'customer_name', 'customer_phone', 'appointment_datetime', 'status', 'selected_time']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Booking::rules(); }
}
