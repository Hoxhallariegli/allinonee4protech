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

#[Title('Add Deal')]
class Create extends Component
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

    public function render() { abort_if_cannot('add_deals'); return view('livewire.admin.c-r-m.deals.create', [
            'contacts' => $this->getcontactsList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateDealAction $action) { $this->validate();  $dto = DealDTO::fromArray([
            'name' => $this->name,
            'contact_id' => $this->contact_id,
            'value' => $this->value,
            'stage' => $this->stage,
        ]); $action->execute($dto); session()->flash('success', __('c-r-m/deals.created')); return to_route('admin.c-r-m.deals.index'); }
    protected function rules(): array { return Deal::rules(); }
}