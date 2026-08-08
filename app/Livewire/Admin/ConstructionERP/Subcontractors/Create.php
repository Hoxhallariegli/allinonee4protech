<?php

namespace App\Livewire\Admin\ConstructionERP\Subcontractors;

use App\Models\ConstructionERP\Subcontractor;
use App\Domain\ConstructionERP\Subcontractor\DTOs\SubcontractorDTO;
use App\Domain\ConstructionERP\Subcontractor\Actions\CreateSubcontractorAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Subcontractor')]
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
        abort_if_cannot('add_subcontractors');
        return view('livewire.admin.construction-e-r-p.subcontractors.create', [
            'projects' => $this->getprojectsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateSubcontractorAction $action) { $this->validate();  $dto = SubcontractorDTO::fromArray([
            'project_id' => $this->project_id,
            'name' => $this->name,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/subcontractors.created')); return to_route('admin.construction-e-r-p.subcontractors.index'); }
    protected function rules(): array { return Subcontractor::rules(); }
}