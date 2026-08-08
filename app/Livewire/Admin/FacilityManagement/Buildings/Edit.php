<?php

namespace App\Livewire\Admin\FacilityManagement\Buildings;

use App\Models\FacilityManagement\Building;
use App\Domain\FacilityManagement\Building\DTOs\BuildingDTO;
use App\Domain\FacilityManagement\Building\Actions\UpdateBuildingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Building')]
class Edit extends Component
{
        use WithPagination;
 public Building $item;
    public $name = '';
    public $address = '';
   
    public function mount(Building $building) { $this->item = $building; $this->fill($building->toArray());  }
    public function render() {
        abort_if_cannot('edit_buildings');
        return view('livewire.admin.facility-management.buildings.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateBuildingAction $action) { $this->validate();  $dto = BuildingDTO::fromArray([
            'name' => $this->name,
            'address' => $this->address,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('facility-management/buildings.updated')); return to_route('admin.facility-management.buildings.index'); }
    protected function rules(): array { return Building::rules($this->item->id); }
}