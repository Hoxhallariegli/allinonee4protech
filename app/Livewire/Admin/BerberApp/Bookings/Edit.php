<?php

namespace App\Livewire\Admin\BerberApp\Bookings;

use App\Models\BerberApp\Booking;
use App\Domain\BerberApp\Booking\DTOs\BookingDTO;
use App\Domain\BerberApp\Booking\Actions\UpdateBookingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Booking')]
class Edit extends Component
{
        use WithPagination;
 public Booking $item;
    public $barber_id = '';
    public $service_id = '';
    public $customer_id = '';
    public $customer_name = '';
    public $customer_phone = '';
    public $appointment_datetime = '';
    public $status = '';
    public $reminder_enabled = '';
    public $reminder_minutes = '';
    public $cancel_reason = '';

    #[On('barber-created')]
    public function refreshBarbers($id) { $this->barber_id = $id; $this->updatedBarberId($id); }

    #[On('service-created')]
    public function refreshServices($id) { $this->service_id = $id; $this->updatedServiceId($id); }

    #[On('customer-created')]
    public function refreshCustomers($id) { $this->customer_id = $id; }

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

    protected function getcustomersList() {
        return \App\Models\BerberApp\Customer::pluck('name', 'id')->toArray();
    }

    public function mount(Booking $booking) { $this->item = $booking; $this->fill($booking->toArray()); $this->appointment_datetime = $booking->appointment_datetime?->format('Y-m-d\TH:i'); }
    public function render() { abort_if_cannot('edit_bookings'); return view('livewire.admin.berber-app.bookings.edit', [
            'barbers' => $this->getbarbersList(),
            'services' => $this->getservicesList(),
            'customers' => $this->getcustomersList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateBookingAction $action) {
        $this->validate();

        $customer = \App\Models\BerberApp\Customer::find($this->customer_id);

        $dto = BookingDTO::fromArray([
            'barber_id' => $this->barber_id,
            'service_id' => $this->service_id,
            'customer_id' => $this->customer_id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'appointment_datetime' => $this->appointment_datetime,
            'status' => $this->status,
            'reminder_enabled' => $this->reminder_enabled,
            'reminder_minutes' => $this->reminder_minutes,
            'cancel_reason' => $this->cancel_reason,
        ]);
        $action->execute($this->item, $dto);
        session()->flash('success', __('berber-app/bookings.updated'));
        return to_route('admin.berber-app.bookings.index');
    }
    protected function rules(): array { return Booking::rules($this->item->id); }
}
