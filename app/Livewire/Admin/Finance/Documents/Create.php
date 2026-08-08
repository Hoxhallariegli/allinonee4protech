<?php

namespace App\Livewire\Admin\Finance\Documents;

use App\Models\Finance\Document;
use App\Domain\Finance\Document\DTOs\DocumentDTO;
use App\Domain\Finance\Document\Actions\CreateDocumentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Document')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $title = '';
    public $file_path = '';
    public $file_type = '';
   
    public function render() {
        abort_if_cannot('add_documents');
        return view('livewire.admin.finance.documents.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateDocumentAction $action) { $this->validate();         if ($this->file_path && !is_string($this->file_path)) { $this->file_path = $this->file_path->store('uploads/documents', 'uploads'); }
        if ($this->file_type && !is_string($this->file_type)) { $this->file_type = $this->file_type->store('uploads/documents', 'uploads'); }
 $dto = DocumentDTO::fromArray([
            'title' => $this->title,
            'file_path' => $this->file_path,
            'file_type' => $this->file_type,
        ]); $action->execute($dto); session()->flash('success', __('finance/documents.created')); return to_route('admin.finance.documents.index'); }
    protected function rules(): array { return Document::rules(); }
}