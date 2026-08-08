<?php

namespace App\Livewire\Admin\CRM\Contacts;

use App\Models\CRM\Contact;
use App\Domain\CRM\Contact\DTOs\ContactDTO;
use App\Domain\CRM\Contact\Actions\UpdateContactAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Contact')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Contact $item;
    public $name = '';
    public $company_id = '';
    public $email = '';
    public $photo = '';
 
    #[On('company-created')] 
    public function refreshCompanies($id) { $this->company_id = $id; $this->updatedCompanyId($id); }
 
    public function updatedCompanyId($value)
    {
        if (!$value) return;
        $related = \App\Models\CRM\Company::find($value);
        if (!$related) return;
    }
 
    protected function getcompaniesList() {
        return \App\Models\CRM\Company::pluck('name', 'id')->toArray();
    }

    public function mount(Contact $contact) { $this->item = $contact; $this->fill($contact->toArray());  }
    public function render() {
        abort_if_cannot('edit_contacts');
        return view('livewire.admin.c-r-m.contacts.edit', [
            'companies' => $this->getcompaniesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateContactAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/contacts', 'uploads'); }
 $dto = ContactDTO::fromArray([
            'name' => $this->name,
            'company_id' => $this->company_id,
            'email' => $this->email,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('c-r-m/contacts.updated')); return to_route('admin.c-r-m.contacts.index'); }
    protected function rules(): array { return Contact::rules($this->item->id); }
}