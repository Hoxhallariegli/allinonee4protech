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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.gym-management.class-schedules.quick-create', [
            'trainers' => $this->gettrainersList(),
        ]); }

    public function store(CreateClassScheduleAction $action)
    {
        $this->validate();
        $dto = ClassScheduleDTO::fromArray([
            'class_name' => $this->class_name,
            'trainer_id' => $this->trainer_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('class-schedule-created', id: $item->id);
        $this->js("Livewire.dispatch('class-schedule-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('gym-management/class-schedules.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['class_name', 'trainer_id', 'start_time', 'end_time']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return ClassSchedule::rules(); }
}