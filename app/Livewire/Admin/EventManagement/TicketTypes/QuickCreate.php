<?php

namespace App\Livewire\Admin\EventManagement\TicketTypes;

use App\Models\EventManagement\TicketType;
use App\Domain\EventManagement\TicketType\DTOs\TicketTypeDTO;
use App\Domain\EventManagement\TicketType\Actions\CreateTicketTypeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.event-management.ticket-types.quick-create', [
            'events' => $this->geteventsList(),
        ]); }

    public function store(CreateTicketTypeAction $action)
    {
        $this->validate();
        $dto = TicketTypeDTO::fromArray([
            'event_id' => $this->event_id,
            'name' => $this->name,
            'price' => $this->price,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('ticket-type-created', id: $item->id);
        $this->js("Livewire.dispatch('ticket-type-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('event-management/ticket-types.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['event_id', 'name', 'price']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return TicketType::rules(); }
}