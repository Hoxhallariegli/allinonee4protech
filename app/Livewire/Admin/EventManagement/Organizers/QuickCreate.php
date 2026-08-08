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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.event-management.organizers.quick-create', [
        ]); }

    public function store(CreateOrganizerAction $action)
    {
        $this->validate();
        $dto = OrganizerDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('organizer-created', id: $item->id);
        $this->js("Livewire.dispatch('organizer-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('event-management/organizers.created'), type: 'success');
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

    protected function rules(): array { return Organizer::rules(); }
}