<?php

namespace App\Livewire\Admin\SchoolManagement\Students;

use App\Models\SchoolManagement\Student;
use App\Domain\SchoolManagement\Student\DTOs\StudentDTO;
use App\Domain\SchoolManagement\Student\Actions\CreateStudentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Student')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $guardian_id = '';
    public $class_id = '';
    public $birth_date = '';
    public $photo = '';
 
    #[On('guardian-created')] 
    public function refreshGuardians($id) { $this->guardian_id = $id; $this->updatedGuardianId($id); }

    #[On('school-class-created')] 
    public function refreshClasses($id) { $this->class_id = $id; $this->updatedClassId($id); }
 
    public function updatedGuardianId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Guardian::find($value);
        if (!$related) return;
    }

    public function updatedClassId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\SchoolClass::find($value);
        if (!$related) return;
    }
 
    protected function getguardiansList() {
        return \App\Models\SchoolManagement\Guardian::pluck('name', 'id')->toArray();
    }

    protected function getclassesList() {
        return \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_students');
        return view('livewire.admin.school-management.students.create', [
            'guardians' => $this->getguardiansList(),
            'classes' => $this->getclassesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateStudentAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/students', 'uploads'); }
 $dto = StudentDTO::fromArray([
            'name' => $this->name,
            'guardian_id' => $this->guardian_id,
            'class_id' => $this->class_id,
            'birth_date' => $this->birth_date,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('school-management/students.created')); return to_route('admin.school-management.students.index'); }
    protected function rules(): array { return Student::rules(); }
}