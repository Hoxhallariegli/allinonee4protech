<?php

namespace App\Livewire\Admin\CRM\Deals;

use App\Models\CRM\Deal;
use App\Domain\CRM\Deal\DTOs\DealDTO;
use App\Domain\CRM\Deal\Actions\CreateDealAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $contact_id = '';
    public $value = '';
    public $stage = '';
 
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

    public function render() { return view('livewire.admin.c-r-m.deals.quick-create', [
            'contacts' => $this->getcontactsList(),
        ]); }

    public function store(CreateDealAction $action)
    {
        $this->validate();
        $dto = DealDTO::fromArray([
            'name' => $this->name,
            'contact_id' => $this->contact_id,
            'value' => $this->value,
            'stage' => $this->stage,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('deal-created', id: $item->id);
        $this->js("Livewire.dispatch('deal-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('c-r-m/deals.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'contact_id', 'value', 'stage']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Deal::rules(); }
}