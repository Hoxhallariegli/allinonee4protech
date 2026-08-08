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

#[Title('Add Attendee')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public function render() {
        abort_if_cannot('add_attendees');
        return view('livewire.admin.event-management.attendees.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateAttendeeAction $action) { $this->validate();  $dto = AttendeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('event-management/attendees.created')); return to_route('admin.event-management.attendees.index'); }
    protected function rules(): array { return Attendee::rules(); }
}