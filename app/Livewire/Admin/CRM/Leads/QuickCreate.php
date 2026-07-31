<?php

namespace App\Livewire\Admin\CRM\Leads;

use App\Models\CRM\Lead;
use App\Domain\CRM\Lead\DTOs\LeadDTO;
use App\Domain\CRM\Lead\Actions\CreateLeadAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.c-r-m.leads.quick-create', [
            'companies' => $this->getcompaniesList(),
        ]); }

    public function store(CreateLeadAction $action)
    {
        $this->validate();
        $dto = LeadDTO::fromArray([
            'name' => $this->name,
            'company_id' => $this->company_id,
            'source' => $this->source,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('lead-created', id: $item->id);
        $this->js("Livewire.dispatch('lead-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('c-r-m/leads.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'company_id', 'source', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Lead::rules(); }
}