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

#[Title('Add Trainer')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $specialization = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_trainers');
        return view('livewire.admin.gym-management.trainers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateTrainerAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/trainers', 'uploads'); }
 $dto = TrainerDTO::fromArray([
            'name' => $this->name,
            'specialization' => $this->specialization,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('gym-management/trainers.created')); return to_route('admin.gym-management.trainers.index'); }
    protected function rules(): array { return Trainer::rules(); }
}