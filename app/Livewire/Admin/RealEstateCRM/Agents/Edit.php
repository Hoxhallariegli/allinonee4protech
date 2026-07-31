<?php

namespace App\Livewire\Admin\RealEstateCRM\Agents;

use App\Models\RealEstateCRM\Agent;
use App\Domain\RealEstateCRM\Agent\DTOs\AgentDTO;
use App\Domain\RealEstateCRM\Agent\Actions\UpdateAgentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Agent')]
class Edit extends Component
{
        use WithPagination;
 public Agent $item;
    public $name = '';
    public $phone = '';
   
    public function mount(Agent $agent) { $this->item = $agent; $this->fill($agent->toArray());  }
    public function render() { abort_if_cannot('edit_agents'); return view('livewire.admin.real-estate-c-r-m.agents.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateAgentAction $action) { $this->validate();  $dto = AgentDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('real-estate-c-r-m/agents.updated')); return to_route('admin.real-estate-c-r-m.agents.index'); }
    protected function rules(): array { return Agent::rules($this->item->id); }
}