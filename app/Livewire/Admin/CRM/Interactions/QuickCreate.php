<?php

namespace App\Livewire\Admin\CRM\Interactions;

use App\Models\CRM\Interaction;
use App\Domain\CRM\Interaction\DTOs\InteractionDTO;
use App\Domain\CRM\Interaction\Actions\CreateInteractionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $contact_id = '';
    public $type = '';
    public $notes = '';
 
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

    public function render() { return view('livewire.admin.c-r-m.interactions.quick-create', [
            'contacts' => $this->getcontactsList(),
        ]); }

    public function store(CreateInteractionAction $action)
    {
        $this->validate();
        $dto = InteractionDTO::fromArray([
            'contact_id' => $this->contact_id,
            'type' => $this->type,
            'notes' => $this->notes,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('interaction-created', id: $item->id);
        $this->js("Livewire.dispatch('interaction-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('c-r-m/interactions.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['contact_id', 'type', 'notes']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Interaction::rules(); }
}