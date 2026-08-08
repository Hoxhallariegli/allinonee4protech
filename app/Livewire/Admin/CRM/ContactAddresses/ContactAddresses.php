<?php

namespace App\Livewire\Admin\CRM\ContactAddresses;

use App\Models\CRM\ContactAddress;
use App\Domain\CRM\ContactAddress\Queries\ContactAddressListQuery;
use App\Domain\CRM\ContactAddress\Actions\DeleteContactAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('ContactAddresses')]
class ContactAddresses extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $contact_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'contact_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_contact_addresses');
        $query = (new ContactAddressListQuery())->handle(['search' => $this->search,             'contact_id' => $this->contact_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.c-r-m.contact-addresses.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => ContactAddress::sortable(),
            'contacts' => \App\Models\CRM\Contact::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, ContactAddress::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteContactAddress($id, DeleteContactAddressAction $action) 
    {
        abort_if_cannot('delete_contact_addresses');
        $item = ContactAddress::find($id);
        if (!$item) { $this->dispatch('toast', message: __('c-r-m/contact-addresses.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('c-r-m/contact-addresses.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('c-r-m/contact-addresses.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('c-r-m/contact-addresses.delete_error'), type: 'error'); }
    }
}