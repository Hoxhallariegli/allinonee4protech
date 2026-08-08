<?php

namespace App\Livewire\Admin\EventManagement\Attendees;

use App\Models\EventManagement\Attendee;
use App\Domain\EventManagement\Attendee\DTOs\AttendeeDTO;
use App\Domain\EventManagement\Attendee\Actions\UpdateAttendeeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Attendee')]
class Edit extends Component
{
        use WithPagination;
 public Attendee $item;
    public $name = '';
    public $email = '';
    public $phone = '';
   
    public function mount(Attendee $attendee) { $this->item = $attendee; $this->fill($attendee->toArray());  }
    public function render() {
        abort_if_cannot('edit_attendees');
        return view('livewire.admin.event-management.attendees.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateAttendeeAction $action) { $this->validate();  $dto = AttendeeDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('event-management/attendees.updated')); return to_route('admin.event-management.attendees.index'); }
    protected function rules(): array { return Attendee::rules($this->item->id); }
}