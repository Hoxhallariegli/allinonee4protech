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

#[Title('Add SchoolClass')]
class Create extends Component
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

    public function render() {
        abort_if_cannot('add_school_classes');
        return view('livewire.admin.school-management.school-classes.create', [
            'teachers' => $this->getteachersList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateSchoolClassAction $action) { $this->validate();  $dto = SchoolClassDTO::fromArray([
            'name' => $this->name,
            'teacher_id' => $this->teacher_id,
            'capacity' => $this->capacity,
        ]); $action->execute($dto); session()->flash('success', __('school-management/school-classes.created')); return to_route('admin.school-management.school-classes.index'); }
    protected function rules(): array { return SchoolClass::rules(); }
}