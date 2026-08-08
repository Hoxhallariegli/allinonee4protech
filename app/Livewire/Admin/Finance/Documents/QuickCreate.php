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

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $title = '';
    public $file_path = '';
    public $file_type = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.finance.documents.quick-create', [
        ]); }

    public function store(CreateDocumentAction $action)
    {
        $this->validate();
        if ($this->file_path && !is_string($this->file_path)) { $this->file_path = $this->file_path->store('uploads/documents', 'uploads'); }
        if ($this->file_type && !is_string($this->file_type)) { $this->file_type = $this->file_type->store('uploads/documents', 'uploads'); }
        $dto = DocumentDTO::fromArray([
            'title' => $this->title,
            'file_path' => $this->file_path,
            'file_type' => $this->file_type,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('document-created', id: $item->id);
        $this->js("Livewire.dispatch('document-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('finance/documents.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->title ?? $item->id);
        $this->reset(['title', 'file_path', 'file_type']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Document::rules(); }
}