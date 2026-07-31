<?php

namespace App\Livewire\Admin\SchoolManagement\SchoolClasses;

use App\Models\SchoolManagement\SchoolClass;
use App\Domain\SchoolManagement\SchoolClass\DTOs\SchoolClassDTO;
use App\Domain\SchoolManagement\SchoolClass\Actions\CreateSchoolClassAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $teacher_id = '';
    public $capacity = '';
 
    #[On('teacher-created')] 
    public function refreshTeachers($id) { $this->teacher_id = $id; $this->updatedTeacherId($id); }
 
    public function updatedTeacherId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Teacher::find($value);
        if (!$related) return;
    }
 
    protected function getteachersList() {
        return \App\Models\SchoolManagement\Teacher::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.school-classes.quick-create', [
            'teachers' => $this->getteachersList(),
        ]); }

    public function store(CreateSchoolClassAction $action)
    {
        $this->validate();
        $dto = SchoolClassDTO::fromArray([
            'name' => $this->name,
            'teacher_id' => $this->teacher_id,
            'capacity' => $this->capacity,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('school-class-created', id: $item->id);
        $this->js("Livewire.dispatch('school-class-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/school-classes.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'teacher_id', 'capacity']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return SchoolClass::rules(); }
}