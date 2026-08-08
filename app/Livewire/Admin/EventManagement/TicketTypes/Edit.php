<?php

namespace App\Livewire\Admin\EventManagement\TicketTypes;

use App\Models\EventManagement\TicketType;
use App\Domain\EventManagement\TicketType\DTOs\TicketTypeDTO;
use App\Domain\EventManagement\TicketType\Actions\UpdateTicketTypeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit TicketType')]
class Edit extends Component
{
        use WithPagination;
 public TicketType $item;
    public $event_id = '';
    public $name = '';
    public $price = '';
 
    #[On('event-created')] 
    public function refreshEvents($id) { $this->event_id = $id; $this->updatedEventId($id); }
 
    public function updatedEventId($value)
    {
        if (!$value) return;
        $related = \App\Models\EventManagement\Event::find($value);
        if (!$related) return;
    }
 
    protected function geteventsList() {
        return \App\Models\EventManagement\Event::pluck('title', 'id')->toArray();
    }

    public function mount(TicketType $ticketType) { $this->item = $ticketType; $this->fill($ticketType->toArray());  }
    public function render() {
        abort_if_cannot('edit_ticket_types');
        return view('livewire.admin.event-management.ticket-types.edit', [
            'events' => $this->geteventsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateTicketTypeAction $action) { $this->validate();  $dto = TicketTypeDTO::fromArray([
            'event_id' => $this->event_id,
            'name' => $this->name,
            'price' => $this->price,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('event-management/ticket-types.updated')); return to_route('admin.event-management.ticket-types.index'); }
    protected function rules(): array { return TicketType::rules($this->item->id); }
}