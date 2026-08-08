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

#[Title('Add HeavyMachinery')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_heavy_machineries');
        return view('livewire.admin.construction-e-r-p.heavy-machineries.create', [
            'projects' => $this->getprojectsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateHeavyMachineryAction $action) { $this->validate();  $dto = HeavyMachineryDTO::fromArray([
            'project_id' => $this->project_id,
            'name' => $this->name,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/heavy-machineries.created')); return to_route('admin.construction-e-r-p.heavy-machineries.index'); }
    protected function rules(): array { return HeavyMachinery::rules(); }
}