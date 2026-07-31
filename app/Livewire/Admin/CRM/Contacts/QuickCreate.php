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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.c-r-m.contacts.quick-create', [
            'companies' => $this->getcompaniesList(),
        ]); }

    public function store(CreateContactAction $action)
    {
        $this->validate();
        $dto = ContactDTO::fromArray([
            'name' => $this->name,
            'company_id' => $this->company_id,
            'email' => $this->email,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('contact-created', id: $item->id);
        $this->js("Livewire.dispatch('contact-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('c-r-m/contacts.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'company_id', 'email']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Contact::rules(); }
}