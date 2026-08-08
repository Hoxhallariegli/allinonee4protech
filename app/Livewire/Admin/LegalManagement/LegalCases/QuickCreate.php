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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.legal-management.legal-cases.quick-create', [
            'clients' => $this->getclientsList(),
        ]); }

    public function store(CreateLegalCaseAction $action)
    {
        $this->validate();
        $dto = LegalCaseDTO::fromArray([
            'title' => $this->title,
            'client_id' => $this->client_id,
            'status' => $this->status,
            'description' => $this->description,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('legal-case-created', id: $item->id);
        $this->js("Livewire.dispatch('legal-case-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('legal-management/legal-cases.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->title ?? $item->id);
        $this->reset(['title', 'client_id', 'status', 'description']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return LegalCase::rules(); }
}