<?php

namespace App\Livewire\Admin\BerberApp\Bookings;

use App\Models\BerberApp\Booking;
use App\Domain\BerberApp\Booking\Queries\BookingListQuery;
use App\Domain\BerberApp\Booking\Actions\DeleteBookingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Bookings')]
class Bookings extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $barber_id = '';
    #[Url(history: true)] public $service_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    // Daily Slots Logic
    public $viewMode = 'table'; // table or schedule
    public $viewDate;

    public function mount()
    {
        $this->viewDate = now()->format('Y-m-d');
    }

    public function getDailySlotsProperty()
    {
        $slots = [];
        $start = \Carbon\Carbon::parse($this->viewDate . ' 09:00');
        $end = \Carbon\Carbon::parse($this->viewDate . ' 19:00');

        $activeBarbers = \App\Models\BerberApp\Barber::where('active', true)->get();

        while ($start < $end) {
            $timeString = $start->format('H:i');
            $slotBookings = Booking::where('appointment_datetime', $start->toDateTimeString())
                ->where('status', '!=', 'cancelled')
                ->with(['barber', 'service'])
                ->get();

            $slots[] = [
                'time' => $timeString,
                'datetime' => $start->toDateTimeString(),
                'bookings' => $slotBookings,
                'available' => $slotBookings->count() < $activeBarbers->count()
            ];

            $start->addMinutes(30);
        }
        return $slots;
    }

    public function resetFilters() { $this->reset(['search', 'openFilter', 'barber_id', 'service_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_bookings');
        $query = (new BookingListQuery())->handle(['search' => $this->search,             'barber_id' => $this->barber_id,
            'service_id' => $this->service_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.berber-app.bookings.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Booking::sortable(),
            'barbers' => \App\Models\BerberApp\Barber::pluck('name', 'id')->toArray(),
            'services' => \App\Models\BerberApp\Service::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Booking::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteBooking($id, DeleteBookingAction $action)
    {
        abort_if_cannot('delete_bookings');
        $item = Booking::find($id);
        if (!$item) { $this->dispatch('toast', message: __('berber-app/bookings.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('berber-app/bookings.deleted'), type: 'success'); $this->resetPage(); }
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('berber-app/bookings.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('berber-app/bookings.delete_error'), type: 'error'); }
    }
}
