<?php

namespace App\Livewire\Admin\EventManagement\Organizers;

use App\Models\EventManagement\Organizer;
use App\Domain\EventManagement\Organizer\DTOs\OrganizerDTO;
use App\Domain\EventManagement\Organizer\Actions\CreateOrganizerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Organizer')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public function render() {
        abort_if_cannot('add_organizers');
        return view('livewire.admin.event-management.organizers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateOrganizerAction $action) { $this->validate();  $dto = OrganizerDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('event-management/organizers.created')); return to_route('admin.event-management.organizers.index'); }
    protected function rules(): array { return Organizer::rules(); }
}