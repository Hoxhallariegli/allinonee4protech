<?php

namespace App\Livewire\Admin\ConstructionERP\Buildings;

use App\Models\ConstructionERP\Building;
use App\Domain\ConstructionERP\Building\DTOs\BuildingDTO;
use App\Domain\ConstructionERP\Building\Actions\CreateBuildingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.construction-e-r-p.buildings.quick-create', [
            'projects' => $this->getprojectsList(),
        ]); }

    public function store(CreateBuildingAction $action)
    {
        $this->validate();
        $dto = BuildingDTO::fromArray([
            'project_id' => $this->project_id,
            'name' => $this->name,
            'floors' => $this->floors,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('building-created', id: $item->id);
        $this->js("Livewire.dispatch('building-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('construction-e-r-p/buildings.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['project_id', 'name', 'floors']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Building::rules(); }
}