<?php

namespace App\Livewire\Admin\Finance\Documents;

use App\Models\Finance\Document;
use App\Domain\Finance\Document\DTOs\DocumentDTO;
use App\Domain\Finance\Document\Actions\UpdateDocumentAction;
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
    public $title = '';
    public $file_path = '';
    public $file_type = '';
   
    public function mount(Document $document) { $this->item = $document; $this->fill($document->toArray());  }
    public function render() {
        abort_if_cannot('edit_documents');
        return view('livewire.admin.finance.documents.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateDocumentAction $action) { $this->validate();         if ($this->file_path && !is_string($this->file_path)) { $this->file_path = $this->file_path->store('uploads/documents', 'uploads'); }
        if ($this->file_type && !is_string($this->file_type)) { $this->file_type = $this->file_type->store('uploads/documents', 'uploads'); }
 $dto = DocumentDTO::fromArray([
            'title' => $this->title,
            'file_path' => $this->file_path,
            'file_type' => $this->file_type,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('finance/documents.updated')); return to_route('admin.finance.documents.index'); }
    protected function rules(): array { return Document::rules($this->item->id); }
}