<?php

namespace App\Livewire\Admin\ConstructionERP\Projects;

use App\Models\ConstructionERP\Project;
use App\Domain\ConstructionERP\Project\DTOs\ProjectDTO;
use App\Domain\ConstructionERP\Project\Actions\UpdateProjectAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Project')]
class Edit extends Component
{
        use WithPagination;
 public Project $item;
    public $name = '';
    public $client_id = '';
    public $start_date = '';
    public $budget = '';
    public $status = '';
 
    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }
 
    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Client::find($value);
        if (!$related) return;
    }
 
    protected function getclientsList() {
        return \App\Models\ConstructionERP\Client::pluck('name', 'id')->toArray();
    }

    public function mount(Project $project) { $this->item = $project; $this->fill($project->toArray()); $this->start_date = $project->start_date?->format('Y-m-d'); }
    public function render() { abort_if_cannot('edit_projects'); return view('livewire.admin.construction-e-r-p.projects.edit', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateProjectAction $action) { $this->validate();  $dto = ProjectDTO::fromArray([
            'name' => $this->name,
            'client_id' => $this->client_id,
            'start_date' => $this->start_date,
            'budget' => $this->budget,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/projects.updated')); return to_route('admin.construction-e-r-p.projects.index'); }
    protected function rules(): array { return Project::rules($this->item->id); }
}