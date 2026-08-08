<?php

namespace App\Livewire\Admin\EventManagement\Events;

use App\Models\EventManagement\Event;
use App\Domain\EventManagement\Event\DTOs\EventDTO;
use App\Domain\EventManagement\Event\Actions\CreateEventAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $title = '';
    public $organizer_id = '';
    public $event_date = '';
    public $location = '';
 
    #[On('organizer-created')] 
    public function refreshOrganizers($id) { $this->organizer_id = $id; $this->updatedOrganizerId($id); }
 
    public function updatedOrganizerId($value)
    {
        if (!$value) return;
        $related = \App\Models\EventManagement\Organizer::find($value);
        if (!$related) return;
    }
 
    protected function getorganizersList() {
        return \App\Models\EventManagement\Organizer::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.event-management.events.quick-create', [
            'organizers' => $this->getorganizersList(),
        ]); }

    public function store(CreateEventAction $action)
    {
        $this->validate();
        $dto = EventDTO::fromArray([
            'title' => $this->title,
            'organizer_id' => $this->organizer_id,
            'event_date' => $this->event_date,
            'location' => $this->location,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('event-created', id: $item->id);
        $this->js("Livewire.dispatch('event-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('event-management/events.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->title ?? $item->id);
        $this->reset(['title', 'organizer_id', 'event_date', 'location']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Event::rules(); }
}