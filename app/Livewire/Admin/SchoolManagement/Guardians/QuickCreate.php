<?php

namespace App\Livewire\Admin\SchoolManagement\Guardians;

use App\Models\SchoolManagement\Guardian;
use App\Domain\SchoolManagement\Guardian\DTOs\GuardianDTO;
use App\Domain\SchoolManagement\Guardian\Actions\CreateGuardianAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
    public $email = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.guardians.quick-create', [
        ]); }

    public function store(CreateGuardianAction $action)
    {
        $this->validate();
        $dto = GuardianDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('guardian-created', id: $item->id);
        $this->js("Livewire.dispatch('guardian-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/guardians.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'phone', 'email']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Guardian::rules(); }
}