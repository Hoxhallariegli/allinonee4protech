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

#[Title('Add MaintenanceRequest')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_maintenance_requests');
        return view('livewire.admin.facility-management.maintenance-requests.create', [
            'buildings' => $this->getbuildingsList(),
            'technicians' => $this->gettechniciansList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateMaintenanceRequestAction $action) { $this->validate();  $dto = MaintenanceRequestDTO::fromArray([
            'building_id' => $this->building_id,
            'technician_id' => $this->technician_id,
            'description' => $this->description,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('facility-management/maintenance-requests.created')); return to_route('admin.facility-management.maintenance-requests.index'); }
    protected function rules(): array { return MaintenanceRequest::rules(); }
}