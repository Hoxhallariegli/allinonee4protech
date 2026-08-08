<?php

namespace App\Livewire\Admin\ConstructionERP\Buildings;

use App\Models\ConstructionERP\Building;
use App\Domain\ConstructionERP\Building\DTOs\BuildingDTO;
use App\Domain\ConstructionERP\Building\Actions\UpdateBuildingAction;
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
    public $project_id = '';
    public $name = '';
    public $floors = '';
 
    #[On('project-created')] 
    public function refreshProjects($id) { $this->project_id = $id; $this->updatedProjectId($id); }
 
    public function updatedProjectId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Project::find($value);
        if (!$related) return;
    }
 
    protected function getprojectsList() {
        return \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray();
    }

    public function mount(Building $building) { $this->item = $building; $this->fill($building->toArray());  }
    public function render() {
        abort_if_cannot('edit_buildings');
        return view('livewire.admin.construction-e-r-p.buildings.edit', [
            'projects' => $this->getprojectsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateBuildingAction $action) { $this->validate();  $dto = BuildingDTO::fromArray([
            'project_id' => $this->project_id,
            'name' => $this->name,
            'floors' => $this->floors,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/buildings.updated')); return to_route('admin.construction-e-r-p.buildings.index'); }
    protected function rules(): array { return Building::rules($this->item->id); }
}