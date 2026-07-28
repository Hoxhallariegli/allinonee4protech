<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Domain\Appointment\DTOs\AppointmentDTO;
use App\Domain\Appointment\Actions\UpdateAppointmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Appointment')]
class Edit extends Component
{
        use WithPagination;
 public Appointment $item;
    public $vehicle_id = '';
    public $appointment_date = '';
    public $status = '';
    public $notes = '';
 
    #[On('vehicle-created')] 
    public function refreshVehicles($id) { $this->vehicle_id = $id; $this->updatedVehicleId($id); }
 
    public function updatedVehicleId($value)
    {
        if (!$value) return;
        $related = \App\Models\Vehicle::find($value);
        if (!$related) return;
    }
 
    protected function getvehiclesList() {
        return \App\Models\Vehicle::pluck('license_plate', 'id')->toArray();
    }

    public function mount(Appointment $appointment) { $this->item = $appointment; $this->fill($appointment->toArray()); $this->appointment_date = $appointment->appointment_date?->format('Y-m-d\TH:i'); }
    public function render() { abort_if_cannot('edit_appointments'); return view('livewire.admin.appointments.edit', [
            'vehicles' => $this->getvehiclesList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateAppointmentAction $action) { $this->validate();  $dto = AppointmentDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'appointment_date' => $this->appointment_date,
            'status' => $this->status,
            'notes' => $this->notes,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('appointments.updated')); return to_route('admin.appointments.index'); }
    protected function rules(): array { return Appointment::rules($this->item->id); }
}