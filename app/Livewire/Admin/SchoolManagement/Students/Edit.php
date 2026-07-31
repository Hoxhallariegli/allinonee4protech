<?php

namespace App\Livewire\Admin\SchoolManagement\Students;

use App\Models\SchoolManagement\Student;
use App\Domain\SchoolManagement\Student\DTOs\StudentDTO;
use App\Domain\SchoolManagement\Student\Actions\UpdateStudentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Student')]
class Edit extends Component
{
        use WithPagination;
 public Student $item;
    public $name = '';
    public $guardian_id = '';
    public $class_id = '';
    public $birth_date = '';
 
    #[On('guardian-created')] 
    public function refreshGuardians($id) { $this->guardian_id = $id; $this->updatedGuardianId($id); }

    #[On('school-class-created')] 
    public function refreshClasses($id) { $this->class_id = $id; $this->updatedClassId($id); }
 
    public function updatedGuardianId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Guardian::find($value);
        if (!$related) return;
        if (isset($related->class_id)) { $this->class_id = $related->class_id; }
    }

    public function updatedClassId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\SchoolClass::find($value);
        if (!$related) return;
        if (isset($related->guardian_id)) { $this->guardian_id = $related->guardian_id; }
    }
 
    protected function getguardiansList() {
        return \App\Models\SchoolManagement\Guardian::pluck('name', 'id')->toArray();
    }

    protected function getclassesList() {
        return \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray();
    }

    public function mount(Student $student) { $this->item = $student; $this->fill($student->toArray()); $this->birth_date = $student->birth_date?->format('Y-m-d'); }
    public function render() { abort_if_cannot('edit_students'); return view('livewire.admin.school-management.students.edit', [
            'guardians' => $this->getguardiansList(),
            'classes' => $this->getclassesList(),
        ])->layout('components.layouts.app'); }
    public function update(UpdateStudentAction $action) { $this->validate();  $dto = StudentDTO::fromArray([
            'name' => $this->name,
            'guardian_id' => $this->guardian_id,
            'class_id' => $this->class_id,
            'birth_date' => $this->birth_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/students.updated')); return to_route('admin.school-management.students.index'); }
    protected function rules(): array { return Student::rules($this->item->id); }
}