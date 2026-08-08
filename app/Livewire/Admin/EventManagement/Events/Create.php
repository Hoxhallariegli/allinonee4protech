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

#[Title('Add Event')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_events');
        return view('livewire.admin.event-management.events.create', [
            'organizers' => $this->getorganizersList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateEventAction $action) { $this->validate();  $dto = EventDTO::fromArray([
            'title' => $this->title,
            'organizer_id' => $this->organizer_id,
            'event_date' => $this->event_date,
            'location' => $this->location,
        ]); $action->execute($dto); session()->flash('success', __('event-management/events.created')); return to_route('admin.event-management.events.index'); }
    protected function rules(): array { return Event::rules(); }
}