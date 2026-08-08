<?php

namespace App\Livewire\Admin\FacilityManagement\Buildings;

use App\Models\FacilityManagement\Building;
use App\Domain\FacilityManagement\Building\DTOs\BuildingDTO;
use App\Domain\FacilityManagement\Building\Actions\CreateBuildingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Building')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $address = '';
   
    public function render() {
        abort_if_cannot('add_buildings');
        return view('livewire.admin.facility-management.buildings.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateBuildingAction $action) { $this->validate();  $dto = BuildingDTO::fromArray([
            'name' => $this->name,
            'address' => $this->address,
        ]); $action->execute($dto); session()->flash('success', __('facility-management/buildings.created')); return to_route('admin.facility-management.buildings.index'); }
    protected function rules(): array { return Building::rules(); }
}