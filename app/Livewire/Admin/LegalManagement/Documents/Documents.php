<?php

namespace App\Livewire\Admin\LegalManagement\Documents;

use App\Models\LegalManagement\Document;
use App\Domain\LegalManagement\Document\Queries\DocumentListQuery;
use App\Domain\LegalManagement\Document\Actions\DeleteDocumentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Documents')]
class Documents extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $case_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'case_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_documents');
        $query = (new DocumentListQuery())->handle(['search' => $this->search,             'case_id' => $this->case_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.legal-management.documents.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Document::sortable(),
            'cases' => \App\Models\LegalManagement\LegalCase::pluck('title', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Document::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteDocument($id, DeleteDocumentAction $action) 
    {
        abort_if_cannot('delete_documents');
        $item = Document::find($id);
        if (!$item) { $this->dispatch('toast', message: __('legal-management/documents.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('legal-management/documents.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('legal-management/documents.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('legal-management/documents.delete_error'), type: 'error'); }
    }
}