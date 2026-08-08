<?php

namespace App\Livewire\Admin\LegalManagement\Billings;

use App\Models\LegalManagement\Billing;
use App\Domain\LegalManagement\Billing\DTOs\BillingDTO;
use App\Domain\LegalManagement\Billing\Actions\UpdateBillingAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Billing')]
class Edit extends Component
{
        use WithPagination;
 public Billing $item;
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

    public function mount(Billing $billing) { $this->item = $billing; $this->fill($billing->toArray());  }
    public function render() {
        abort_if_cannot('edit_billings');
        return view('livewire.admin.legal-management.billings.edit', [
            'cases' => $this->getcasesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateBillingAction $action) { $this->validate();  $dto = BillingDTO::fromArray([
            'case_id' => $this->case_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('legal-management/billings.updated')); return to_route('admin.legal-management.billings.index'); }
    protected function rules(): array { return Billing::rules($this->item->id); }
}