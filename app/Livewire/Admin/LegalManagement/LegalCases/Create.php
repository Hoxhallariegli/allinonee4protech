<?php

namespace App\Livewire\Admin\LegalManagement\LegalCases;

use App\Models\LegalManagement\LegalCase;
use App\Domain\LegalManagement\LegalCase\DTOs\LegalCaseDTO;
use App\Domain\LegalManagement\LegalCase\Actions\CreateLegalCaseAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add LegalCase')]
class Create extends Component
{
        use WithPagination;
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

    public function render() {
        abort_if_cannot('add_legal_cases');
        return view('livewire.admin.legal-management.legal-cases.create', [
            'clients' => $this->getclientsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateLegalCaseAction $action) { $this->validate();  $dto = LegalCaseDTO::fromArray([
            'title' => $this->title,
            'client_id' => $this->client_id,
            'status' => $this->status,
            'description' => $this->description,
        ]); $action->execute($dto); session()->flash('success', __('legal-management/legal-cases.created')); return to_route('admin.legal-management.legal-cases.index'); }
    protected function rules(): array { return LegalCase::rules(); }
}