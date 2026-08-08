<?php

namespace App\Livewire\Admin\GymManagement\ClassSchedules;

use App\Models\GymManagement\ClassSchedule;
use App\Domain\GymManagement\ClassSchedule\DTOs\ClassScheduleDTO;
use App\Domain\GymManagement\ClassSchedule\Actions\CreateClassScheduleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add ClassSchedule')]
class Create extends Component
{
        use WithPagination;
     public $class_name = '';
    public $trainer_id = '';
    public $start_time = '';
    public $end_time = '';
 
    #[On('trainer-created')] 
    public function refreshTrainers($id) { $this->trainer_id = $id; $this->updatedTrainerId($id); }
 
    public function updatedTrainerId($value)
    {
        if (!$value) return;
        $related = \App\Models\GymManagement\Trainer::find($value);
        if (!$related) return;
    }
 
    protected function gettrainersList() {
        return \App\Models\GymManagement\Trainer::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_class_schedules');
        return view('livewire.admin.gym-management.class-schedules.create', [
            'trainers' => $this->gettrainersList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateClassScheduleAction $action) { $this->validate();  $dto = ClassScheduleDTO::fromArray([
            'class_name' => $this->class_name,
            'trainer_id' => $this->trainer_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]); $action->execute($dto); session()->flash('success', __('gym-management/class-schedules.created')); return to_route('admin.gym-management.class-schedules.index'); }
    protected function rules(): array { return ClassSchedule::rules(); }
}