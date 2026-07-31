<?php

namespace App\Livewire\Admin\AutoRepairManagement\VehicleDocuments;

use App\Models\AutoRepairManagement\VehicleDocument;
use App\Domain\AutoRepairManagement\VehicleDocument\DTOs\VehicleDocumentDTO;
use App\Domain\AutoRepairManagement\VehicleDocument\Actions\CreateVehicleDocumentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $type = '';
    public $document = '';
    public $vehicle_id = '';
 
    #[On('vehicle-created')] 
    public function refreshVehicles($id) { $this->vehicle_id = $id; $this->updatedVehicleId($id); }
 
    public function updatedVehicleId($value)
    {
        if (!$value) return;
        $related = \App\Models\AutoRepairManagement\Vehicle::find($value);
        if (!$related) return;
    }
 
    protected function getvehiclesList() {
        return \App\Models\AutoRepairManagement\Vehicle::pluck('license_plate', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.vehicle-documents.quick-create', [
            'vehicles' => $this->getvehiclesList(),
        ]); }

    public function store(CreateVehicleDocumentAction $action)
    {
        $this->validate();
        if ($this->document && !is_string($this->document)) { $this->document = $this->document->store('uploads/vehicle-documents', 'public'); }
        $dto = VehicleDocumentDTO::fromArray([
            'type' => $this->type,
            'document' => $this->document,
            'vehicle_id' => $this->vehicle_id,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('vehicle-document-created', id: $item->id);
        $this->js("Livewire.dispatch('vehicle-document-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/vehicle-documents.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['type', 'document', 'vehicle_id']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return VehicleDocument::rules(); }
}