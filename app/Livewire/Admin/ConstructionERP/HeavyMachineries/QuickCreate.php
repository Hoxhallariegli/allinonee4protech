<?php

namespace App\Livewire\Admin\ConstructionERP\HeavyMachineries;

use App\Models\ConstructionERP\HeavyMachinery;
use App\Domain\ConstructionERP\HeavyMachinery\DTOs\HeavyMachineryDTO;
use App\Domain\ConstructionERP\HeavyMachinery\Actions\CreateHeavyMachineryAction;
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

    public function render() { return view('livewire.admin.construction-e-r-p.heavy-machineries.quick-create', [
            'projects' => $this->getprojectsList(),
        ]); }

    public function store(CreateHeavyMachineryAction $action)
    {
        $this->validate();
        $dto = HeavyMachineryDTO::fromArray([
            'project_id' => $this->project_id,
            'name' => $this->name,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('heavy-machinery-created', id: $item->id);
        $this->js("Livewire.dispatch('heavy-machinery-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('construction-e-r-p/heavy-machineries.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['project_id', 'name']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return HeavyMachinery::rules(); }
}