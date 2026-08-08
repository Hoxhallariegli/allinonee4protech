<?php

namespace App\Livewire\Admin\CRM\ContactAddresses;

use App\Models\CRM\ContactAddress;
use App\Domain\CRM\ContactAddress\DTOs\ContactAddressDTO;
use App\Domain\CRM\ContactAddress\Actions\CreateContactAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $contact_id = '';
    public $address = '';
 
    #[On('contact-created')] 
    public function refreshContacts($id) { $this->contact_id = $id; $this->updatedContactId($id); }
 
    public function updatedContactId($value)
    {
        if (!$value) return;
        $related = \App\Models\CRM\Contact::find($value);
        if (!$related) return;
    }
 
    protected function getcontactsList() {
        return \App\Models\CRM\Contact::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.c-r-m.contact-addresses.quick-create', [
            'contacts' => $this->getcontactsList(),
        ]); }

    public function store(CreateContactAddressAction $action)
    {
        $this->validate();
        $dto = ContactAddressDTO::fromArray([
            'contact_id' => $this->contact_id,
            'address' => $this->address,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('contact-address-created', id: $item->id);
        $this->js("Livewire.dispatch('contact-address-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('c-r-m/contact-addresses.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['contact_id', 'address']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return ContactAddress::rules(); }
}