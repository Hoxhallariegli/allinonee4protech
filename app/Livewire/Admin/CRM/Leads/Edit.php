<?php

namespace App\Livewire\Admin\CRM\Leads;

use App\Models\CRM\Lead;
use App\Domain\CRM\Lead\DTOs\LeadDTO;
use App\Domain\CRM\Lead\Actions\UpdateLeadAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Lead')]
class Edit extends Component
{
        use WithPagination;
 public Lead $item;
    public $name = '';
    public $company_id = '';
    public $source = '';
    public $status = '';
 
    #[On('company-created')] 
    public function refreshCompanies($id) { $this->company_id = $id; $this->updatedCompanyId($id); }
 
    public function updatedCompanyId($value)
    {
        if (!$value) return;
        $related = \App\Models\CRM\Company::find($value);
        if (!$related) return;
    }
 
    protected function getcompaniesList() {
        return \App\Models\CRM\Company::pluck('name', 'id')->toArray();
    }

    public function mount(Lead $lead) { $this->item = $lead; $this->fill($lead->toArray());  }
    public function render() { abort_if_cannot('edit_leads'); return view('livewire.admin.c-r-m.leads.edit', [
            'companies' => $this->getcompaniesList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateLeadAction $action) { $this->validate();  $dto = LeadDTO::fromArray([
            'name' => $this->name,
            'company_id' => $this->company_id,
            'source' => $this->source,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('c-r-m/leads.updated')); return to_route('admin.c-r-m.leads.index'); }
    protected function rules(): array { return Lead::rules($this->item->id); }
}