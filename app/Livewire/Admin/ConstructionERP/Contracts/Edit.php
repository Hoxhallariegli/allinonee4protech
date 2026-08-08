<?php

namespace App\Livewire\Admin\ConstructionERP\Contracts;

use App\Models\ConstructionERP\Contract;
use App\Domain\ConstructionERP\Contract\DTOs\ContractDTO;
use App\Domain\ConstructionERP\Contract\Actions\UpdateContractAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Contract')]
class Edit extends Component
{
        use WithPagination;
 public Contract $item;
    public $project_id = '';
    public $client_id = '';
    public $contract_date = '';
    public $amount = '';
 
    #[On('project-created')] 
    public function refreshProjects($id) { $this->project_id = $id; $this->updatedProjectId($id); }

    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }
 
    public function updatedProjectId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Project::find($value);
        if (!$related) return;
    }

    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\ConstructionERP\Client::find($value);
        if (!$related) return;
    }
 
    protected function getprojectsList() {
        return \App\Models\ConstructionERP\Project::pluck('name', 'id')->toArray();
    }

    protected function getclientsList() {
        return \App\Models\ConstructionERP\Client::pluck('name', 'id')->toArray();
    }

    public function mount(Contract $contract) { $this->item = $contract; $this->fill($contract->toArray()); $this->contract_date = $contract->contract_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_contracts');
        return view('livewire.admin.construction-e-r-p.contracts.edit', [
            'projects' => $this->getprojectsList(),
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateContractAction $action) { $this->validate();  $dto = ContractDTO::fromArray([
            'project_id' => $this->project_id,
            'client_id' => $this->client_id,
            'contract_date' => $this->contract_date,
            'amount' => $this->amount,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('construction-e-r-p/contracts.updated')); return to_route('admin.construction-e-r-p.contracts.index'); }
    protected function rules(): array { return Contract::rules($this->item->id); }
}