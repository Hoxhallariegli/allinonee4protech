<?php

namespace App\Livewire\Admin\CRM\ContactAddresses;

use App\Models\CRM\ContactAddress;
use App\Domain\CRM\ContactAddress\DTOs\ContactAddressDTO;
use App\Domain\CRM\ContactAddress\Actions\UpdateContactAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit ContactAddress')]
class Edit extends Component
{
        use WithPagination;
 public ContactAddress $item;
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

    public function mount(ContactAddress $contactAddress) { $this->item = $contactAddress; $this->fill($contactAddress->toArray());  }
    public function render() {
        abort_if_cannot('edit_contact_addresses');
        return view('livewire.admin.c-r-m.contact-addresses.edit', [
            'contacts' => $this->getcontactsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateContactAddressAction $action) { $this->validate();  $dto = ContactAddressDTO::fromArray([
            'contact_id' => $this->contact_id,
            'address' => $this->address,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('c-r-m/contact-addresses.updated')); return to_route('admin.c-r-m.contact-addresses.index'); }
    protected function rules(): array { return ContactAddress::rules($this->item->id); }
}