<?php

namespace App\Livewire\Admin\LegalManagement\Billings;

use App\Models\LegalManagement\Billing;
use App\Domain\LegalManagement\Billing\DTOs\BillingDTO;
use App\Domain\LegalManagement\Billing\Actions\CreateBillingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $case_id = '';
    public $amount = '';
    public $status = '';
 
    #[On('legal-case-created')] 
    public function refreshCases($id) { $this->case_id = $id; $this->updatedCaseId($id); }
 
    public function updatedCaseId($value)
    {
        if (!$value) return;
        $related = \App\Models\LegalManagement\LegalCase::find($value);
        if (!$related) return;
    }
 
    protected function getcasesList() {
        return \App\Models\LegalManagement\LegalCase::pluck('title', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.legal-management.billings.quick-create', [
            'cases' => $this->getcasesList(),
        ]); }

    public function store(CreateBillingAction $action)
    {
        $this->validate();
        $dto = BillingDTO::fromArray([
            'case_id' => $this->case_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('billing-created', id: $item->id);
        $this->js("Livewire.dispatch('billing-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('legal-management/billings.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['case_id', 'amount', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Billing::rules(); }
}