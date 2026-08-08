<?php

namespace App\Livewire\Admin\LegalManagement\LegalCases;

use App\Models\LegalManagement\LegalCase;
use App\Domain\LegalManagement\LegalCase\DTOs\LegalCaseDTO;
use App\Domain\LegalManagement\LegalCase\Actions\UpdateLegalCaseAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit LegalCase')]
class Edit extends Component
{
        use WithPagination;
 public LegalCase $item;
    public $title = '';
    public $client_id = '';
    public $status = '';
    public $description = '';
 
    #[On('client-created')] 
    public function refreshClients($id) { $this->client_id = $id; $this->updatedClientId($id); }
 
    public function updatedClientId($value)
    {
        if (!$value) return;
        $related = \App\Models\LegalManagement\Client::find($value);
        if (!$related) return;
    }
 
    protected function getclientsList() {
        return \App\Models\LegalManagement\Client::pluck('name', 'id')->toArray();
    }

    public function mount(LegalCase $legalCase) { $this->item = $legalCase; $this->fill($legalCase->toArray());  }
    public function render() {
        abort_if_cannot('edit_legal_cases');
        return view('livewire.admin.legal-management.legal-cases.edit', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateLegalCaseAction $action) { $this->validate();  $dto = LegalCaseDTO::fromArray([
            'title' => $this->title,
            'client_id' => $this->client_id,
            'status' => $this->status,
            'description' => $this->description,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('legal-management/legal-cases.updated')); return to_route('admin.legal-management.legal-cases.index'); }
    protected function rules(): array { return LegalCase::rules($this->item->id); }
}