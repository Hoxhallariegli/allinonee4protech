<?php

namespace App\Livewire\Admin\GymManagement\Trainers;

use App\Models\GymManagement\Trainer;
use App\Domain\GymManagement\Trainer\DTOs\TrainerDTO;
use App\Domain\GymManagement\Trainer\Actions\CreateTrainerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $specialization = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.gym-management.trainers.quick-create', [
        ]); }

    public function store(CreateTrainerAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/trainers', 'uploads'); }
        $dto = TrainerDTO::fromArray([
            'name' => $this->name,
            'specialization' => $this->specialization,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('trainer-created', id: $item->id);
        $this->js("Livewire.dispatch('trainer-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('gym-management/trainers.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'specialization', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Trainer::rules(); }
}