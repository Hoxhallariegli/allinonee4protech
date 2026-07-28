<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Domain\Appointment\DTOs\AppointmentDTO;
use App\Domain\Appointment\Actions\CreateAppointmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.appointments.quick-create', [
            'vehicles' => $this->getvehiclesList(),
        ]); }

    public function store(CreateAppointmentAction $action)
    {
        $this->validate();
        $dto = AppointmentDTO::fromArray([
            'vehicle_id' => $this->vehicle_id,
            'appointment_date' => $this->appointment_date,
            'status' => $this->status,
            'notes' => $this->notes,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('appointment-created', id: $item->id);
        $this->js("Livewire.dispatch('appointment-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('appointments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['vehicle_id', 'appointment_date', 'status', 'notes']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Appointment::rules(); }
}