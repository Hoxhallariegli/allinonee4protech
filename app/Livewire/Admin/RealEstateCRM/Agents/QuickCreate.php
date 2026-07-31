<?php

namespace App\Livewire\Admin\RealEstateCRM\Agents;

use App\Models\RealEstateCRM\Agent;
use App\Domain\RealEstateCRM\Agent\DTOs\AgentDTO;
use App\Domain\RealEstateCRM\Agent\Actions\CreateAgentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.real-estate-c-r-m.agents.quick-create', [
        ]); }

    public function store(CreateAgentAction $action)
    {
        $this->validate();
        $dto = AgentDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('agent-created', id: $item->id);
        $this->js("Livewire.dispatch('agent-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('real-estate-c-r-m/agents.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'phone']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Agent::rules(); }
}