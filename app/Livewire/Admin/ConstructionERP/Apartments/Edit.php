<?php

namespace App\Livewire\Admin\ConstructionERP\Apartments;

use App\Models\ConstructionERP\Apartment;
use App\Domain\ConstructionERP\Apartment\DTOs\ApartmentDTO;
use App\Domain\ConstructionERP\Apartment\Actions\UpdateApartmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Apartment')]
class Edit extends Component
{
        use WithPagination;
 public Apartment $item;
    public $building_id = '';
    public $number = '';
    public $area = '';
    public $status = '';
 
    #[On('building-created')] 
    public function refreshBuildings($id) { $this->building_id = $id; $this->updatedBuildingId($id); }
 
    public function updatedBuildingId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Building::find($value);
        if (!$related) return;
    }
 
    protected function getbuildingsList() {
        return \App\Models\ConstructionERP\Building::pluck('name', 'id')->toArray();
    }

    public function mount(Apartment $apartment) { $this->item = $apartment; $this->fill($apartment->toArray());  }
    public function render() {
        abort_if_cannot('edit_apartments');
        return view('livewire.admin.construction-e-r-p.apartments.edit', [
            'buildings' => $this->getbuildingsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateApartmentAction $action) { $this->validate();  $dto = ApartmentDTO::fromArray([
            'building_id' => $this->building_id,
            'number' => $this->number,
            'area' => $this->area,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/apartments.updated')); return to_route('admin.construction-e-r-p.apartments.index'); }
    protected function rules(): array { return Apartment::rules($this->item->id); }
}