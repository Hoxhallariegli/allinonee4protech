<?php

namespace App\Livewire\Admin\VehicleDocuments;

use App\Models\VehicleDocument;
use App\Domain\VehicleDocument\DTOs\VehicleDocumentDTO;
use App\Domain\VehicleDocument\Actions\UpdateVehicleDocumentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit VehicleDocument')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public VehicleDocument $item;
    public $type = '';
    public $document = '';
    public $vehicle_id = '';
 
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

    public function mount(VehicleDocument $vehicleDocument) { $this->item = $vehicleDocument; $this->fill($vehicleDocument->toArray());  }
    public function render() { abort_if_cannot('edit_vehicle_documents'); return view('livewire.admin.vehicle-documents.edit', [
            'vehicles' => $this->getvehiclesList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateVehicleDocumentAction $action) { $this->validate();         if ($this->document && !is_string($this->document)) { $this->document = $this->document->store('uploads/vehicle-documents', 'public'); }
 $dto = VehicleDocumentDTO::fromArray([
            'type' => $this->type,
            'document' => $this->document,
            'vehicle_id' => $this->vehicle_id,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('vehicle-documents.updated')); return to_route('admin.vehicle-documents.index'); }
    protected function rules(): array { return VehicleDocument::rules($this->item->id); }
}