<?php

namespace App\Livewire\Admin\CRM\Contacts;

use App\Models\CRM\Contact;
use App\Domain\CRM\Contact\Queries\ContactListQuery;
use App\Domain\CRM\Contact\Actions\DeleteContactAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Contacts')]
class Contacts extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $company_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'company_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_contacts');
        $query = (new ContactListQuery())->handle(['search' => $this->search,             'company_id' => $this->company_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.c-r-m.contacts.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Contact::sortable(),
            'companies' => \App\Models\CRM\Company::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Contact::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteContact($id, DeleteContactAction $action) 
    {
        abort_if_cannot('delete_contacts');
        $item = Contact::find($id);
        if (!$item) { $this->dispatch('toast', message: __('c-r-m/contacts.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('c-r-m/contacts.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('c-r-m/contacts.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('c-r-m/contacts.delete_error'), type: 'error'); }
    }
}