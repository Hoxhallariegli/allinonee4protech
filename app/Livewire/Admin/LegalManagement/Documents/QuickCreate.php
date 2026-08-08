<?php

namespace App\Livewire\Admin\LegalManagement\Documents;

use App\Models\LegalManagement\Document;
use App\Domain\LegalManagement\Document\DTOs\DocumentDTO;
use App\Domain\LegalManagement\Document\Actions\CreateDocumentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $case_id = '';
    public $title = '';
    public $file_path = '';
 
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

    public function render() { return view('livewire.admin.legal-management.documents.quick-create', [
            'cases' => $this->getcasesList(),
        ]); }

    public function store(CreateDocumentAction $action)
    {
        $this->validate();
        if ($this->file_path && !is_string($this->file_path)) { $this->file_path = $this->file_path->store('uploads/documents', 'uploads'); }
        $dto = DocumentDTO::fromArray([
            'case_id' => $this->case_id,
            'title' => $this->title,
            'file_path' => $this->file_path,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('document-created', id: $item->id);
        $this->js("Livewire.dispatch('document-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('legal-management/documents.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->title ?? $item->id);
        $this->reset(['case_id', 'title', 'file_path']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Document::rules(); }
}