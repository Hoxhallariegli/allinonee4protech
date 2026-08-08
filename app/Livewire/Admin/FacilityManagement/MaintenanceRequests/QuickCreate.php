<?php

namespace App\Livewire\Admin\FacilityManagement\MaintenanceRequests;

use App\Models\FacilityManagement\MaintenanceRequest;
use App\Domain\FacilityManagement\MaintenanceRequest\DTOs\MaintenanceRequestDTO;
use App\Domain\FacilityManagement\MaintenanceRequest\Actions\CreateMaintenanceRequestAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $building_id = '';
    public $technician_id = '';
    public $description = '';
    public $status = '';
 
    #[On('building-created')] 
    public function refreshBuildings($id) { $this->building_id = $id; $this->updatedBuildingId($id); }

    #[On('technician-created')] 
    public function refreshTechnicians($id) { $this->technician_id = $id; $this->updatedTechnicianId($id); }
 
    public function updatedBuildingId($value)
    {
        if (!$value) return;
        $related = \App\Models\FacilityManagement\Building::find($value);
        if (!$related) return;
    }

    public function updatedTechnicianId($value)
    {
        if (!$value) return;
        $related = \App\Models\FacilityManagement\Technician::find($value);
        if (!$related) return;
    }
 
    protected function getbuildingsList() {
        return \App\Models\FacilityManagement\Building::pluck('name', 'id')->toArray();
    }

    protected function gettechniciansList() {
        return \App\Models\FacilityManagement\Technician::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.facility-management.maintenance-requests.quick-create', [
            'buildings' => $this->getbuildingsList(),
            'technicians' => $this->gettechniciansList(),
        ]); }

    public function store(CreateMaintenanceRequestAction $action)
    {
        $this->validate();
        $dto = MaintenanceRequestDTO::fromArray([
            'building_id' => $this->building_id,
            'technician_id' => $this->technician_id,
            'description' => $this->description,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('maintenance-request-created', id: $item->id);
        $this->js("Livewire.dispatch('maintenance-request-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('facility-management/maintenance-requests.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['building_id', 'technician_id', 'description', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return MaintenanceRequest::rules(); }
}