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

#[Title('Add Agent')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
   
    public function render() { abort_if_cannot('add_agents'); return view('livewire.admin.real-estate-c-r-m.agents.create', [
        ])->layout('components.layouts.app'); }
    public function store(CreateAgentAction $action) { $this->validate();  $dto = AgentDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('real-estate-c-r-m/agents.created')); return to_route('admin.real-estate-c-r-m.agents.index'); }
    protected function rules(): array { return Agent::rules(); }
}