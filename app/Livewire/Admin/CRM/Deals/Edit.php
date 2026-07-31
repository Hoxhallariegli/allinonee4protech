<?php

namespace App\Livewire\Admin\CRM\Deals;

use App\Models\CRM\Deal;
use App\Domain\CRM\Deal\DTOs\DealDTO;
use App\Domain\CRM\Deal\Actions\UpdateDealAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Deal')]
class Edit extends Component
{
        use WithPagination;
 public Deal $item;
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

    public function mount(Deal $deal) { $this->item = $deal; $this->fill($deal->toArray());  }
    public function render() { abort_if_cannot('edit_deals'); return view('livewire.admin.c-r-m.deals.edit', [
            'contacts' => $this->getcontactsList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateDealAction $action) { $this->validate();  $dto = DealDTO::fromArray([
            'name' => $this->name,
            'contact_id' => $this->contact_id,
            'value' => $this->value,
            'stage' => $this->stage,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('c-r-m/deals.updated')); return to_route('admin.c-r-m.deals.index'); }
    protected function rules(): array { return Deal::rules($this->item->id); }
}