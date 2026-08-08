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

#[Title('Add Interaction')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_interactions');
        return view('livewire.admin.c-r-m.interactions.create', [
            'contacts' => $this->getcontactsList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateInteractionAction $action) { $this->validate();  $dto = InteractionDTO::fromArray([
            'contact_id' => $this->contact_id,
            'type' => $this->type,
            'notes' => $this->notes,
        ]); $action->execute($dto); session()->flash('success', __('c-r-m/interactions.created')); return to_route('admin.c-r-m.interactions.index'); }
    protected function rules(): array { return Interaction::rules(); }
}