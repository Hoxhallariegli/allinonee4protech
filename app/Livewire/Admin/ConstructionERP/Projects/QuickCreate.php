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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.construction-e-r-p.projects.quick-create', [
            'clients' => $this->getclientsList(),
        ]); }

    public function store(CreateProjectAction $action)
    {
        $this->validate();
        $dto = ProjectDTO::fromArray([
            'name' => $this->name,
            'client_id' => $this->client_id,
            'start_date' => $this->start_date,
            'budget' => $this->budget,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('project-created', id: $item->id);
        $this->js("Livewire.dispatch('project-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('construction-e-r-p/projects.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'client_id', 'start_date', 'budget', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Project::rules(); }
}