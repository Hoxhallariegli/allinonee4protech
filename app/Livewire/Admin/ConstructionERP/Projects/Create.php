<?php

namespace App\Livewire\Admin\ConstructionERP\Projects;

use App\Models\ConstructionERP\Project;
use App\Domain\ConstructionERP\Project\DTOs\ProjectDTO;
use App\Domain\ConstructionERP\Project\Actions\CreateProjectAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Project')]
class Create extends Component
{
        use WithPagination;
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

    public function render() { abort_if_cannot('add_projects'); return view('livewire.admin.construction-e-r-p.projects.create', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateProjectAction $action) { $this->validate();  $dto = ProjectDTO::fromArray([
            'name' => $this->name,
            'client_id' => $this->client_id,
            'start_date' => $this->start_date,
            'budget' => $this->budget,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/projects.created')); return to_route('admin.construction-e-r-p.projects.index'); }
    protected function rules(): array { return Project::rules(); }
}