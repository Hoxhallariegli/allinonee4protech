<?php

namespace App\Livewire\Admin\LegalManagement\Documents;

use App\Models\LegalManagement\Document;
use App\Domain\LegalManagement\Document\DTOs\DocumentDTO;
use App\Domain\LegalManagement\Document\Actions\UpdateDocumentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Document')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Document $item;
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

    public function mount(Document $document) { $this->item = $document; $this->fill($document->toArray());  }
    public function render() {
        abort_if_cannot('edit_documents');
        return view('livewire.admin.legal-management.documents.edit', [
            'cases' => $this->getcasesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateDocumentAction $action) { $this->validate();         if ($this->file_path && !is_string($this->file_path)) { $this->file_path = $this->file_path->store('uploads/documents', 'uploads'); }
 $dto = DocumentDTO::fromArray([
            'case_id' => $this->case_id,
            'title' => $this->title,
            'file_path' => $this->file_path,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('legal-management/documents.updated')); return to_route('admin.legal-management.documents.index'); }
    protected function rules(): array { return Document::rules($this->item->id); }
}