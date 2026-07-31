<?php

namespace App\Livewire\Admin\CRM\Contacts;

use App\Models\CRM\Contact;
use App\Domain\CRM\Contact\DTOs\ContactDTO;
use App\Domain\CRM\Contact\Actions\CreateContactAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Contact')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $company_id = '';
    public $email = '';
 
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

    public function render() { abort_if_cannot('add_contacts'); return view('livewire.admin.c-r-m.contacts.create', [
            'companies' => $this->getcompaniesList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateContactAction $action) { $this->validate();  $dto = ContactDTO::fromArray([
            'name' => $this->name,
            'company_id' => $this->company_id,
            'email' => $this->email,
        ]); $action->execute($dto); session()->flash('success', __('c-r-m/contacts.created')); return to_route('admin.c-r-m.contacts.index'); }
    protected function rules(): array { return Contact::rules(); }
}