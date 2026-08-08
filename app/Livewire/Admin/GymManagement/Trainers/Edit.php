<?php

namespace App\Livewire\Admin\GymManagement\Trainers;

use App\Models\GymManagement\Trainer;
use App\Domain\GymManagement\Trainer\DTOs\TrainerDTO;
use App\Domain\GymManagement\Trainer\Actions\UpdateTrainerAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Trainer')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Trainer $item;
    public $name = '';
    public $specialization = '';
    public $photo = '';
   
    public function mount(Trainer $trainer) { $this->item = $trainer; $this->fill($trainer->toArray());  }
    public function render() {
        abort_if_cannot('edit_trainers');
        return view('livewire.admin.gym-management.trainers.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateTrainerAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/trainers', 'uploads'); }
 $dto = TrainerDTO::fromArray([
            'name' => $this->name,
            'specialization' => $this->specialization,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('gym-management/trainers.updated')); return to_route('admin.gym-management.trainers.index'); }
    protected function rules(): array { return Trainer::rules($this->item->id); }
}