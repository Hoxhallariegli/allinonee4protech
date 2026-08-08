<?php

namespace App\Livewire\Admin\GymManagement\ClassSchedules;

use App\Models\GymManagement\ClassSchedule;
use App\Domain\GymManagement\ClassSchedule\DTOs\ClassScheduleDTO;
use App\Domain\GymManagement\ClassSchedule\Actions\UpdateClassScheduleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit ClassSchedule')]
class Edit extends Component
{
        use WithPagination;
 public ClassSchedule $item;
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

    public function mount(ClassSchedule $classSchedule) { $this->item = $classSchedule; $this->fill($classSchedule->toArray()); $this->start_time = $classSchedule->start_time?->format('Y-m-d\TH:i'); $this->end_time = $classSchedule->end_time?->format('Y-m-d\TH:i'); }
    public function render() {
        abort_if_cannot('edit_class_schedules');
        return view('livewire.admin.gym-management.class-schedules.edit', [
            'trainers' => $this->gettrainersList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateClassScheduleAction $action) { $this->validate();  $dto = ClassScheduleDTO::fromArray([
            'class_name' => $this->class_name,
            'trainer_id' => $this->trainer_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('gym-management/class-schedules.updated')); return to_route('admin.gym-management.class-schedules.index'); }
    protected function rules(): array { return ClassSchedule::rules($this->item->id); }
}