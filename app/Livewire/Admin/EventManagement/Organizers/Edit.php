<?php

namespace App\Livewire\Admin\EventManagement\Organizers;

use App\Models\EventManagement\Organizer;
use App\Domain\EventManagement\Organizer\DTOs\OrganizerDTO;
use App\Domain\EventManagement\Organizer\Actions\UpdateOrganizerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Organizer')]
class Edit extends Component
{
        use WithPagination;
 public Organizer $item;
    public $name = '';
    public $email = '';
    public $phone = '';
   
    public function mount(Organizer $organizer) { $this->item = $organizer; $this->fill($organizer->toArray());  }
    public function render() {
        abort_if_cannot('edit_organizers');
        return view('livewire.admin.event-management.organizers.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateOrganizerAction $action) { $this->validate();  $dto = OrganizerDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('event-management/organizers.updated')); return to_route('admin.event-management.organizers.index'); }
    protected function rules(): array { return Organizer::rules($this->item->id); }
}