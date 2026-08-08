<?php

namespace App\Livewire\Admin\EventManagement\Attendees;

use App\Models\EventManagement\Attendee;
use App\Domain\EventManagement\Attendee\DTOs\AttendeeDTO;
use App\Domain\EventManagement\Attendee\Actions\CreateAttendeeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.event-management.attendees.quick-create', [
        ]); }

    public function store(CreateAttendeeAction $action)
    {
        $this->validate();
        $dto = AttendeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('attendee-created', id: $item->id);
        $this->js("Livewire.dispatch('attendee-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('event-management/attendees.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'email', 'phone']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Attendee::rules(); }
}