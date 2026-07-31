<?php

namespace App\Livewire\Admin\SchoolManagement\Attendances;

use App\Models\SchoolManagement\Attendance;
use App\Domain\SchoolManagement\Attendance\DTOs\AttendanceDTO;
use App\Domain\SchoolManagement\Attendance\Actions\CreateAttendanceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Attendance')]
class Create extends Component
{
        use WithPagination;
     public $student_id = '';
    public $class_id = '';
    public $date = '';
    public $status = '';
 
    #[On('student-created')] 
    public function refreshStudents($id) { $this->student_id = $id; $this->updatedStudentId($id); }

    #[On('school-class-created')] 
    public function refreshClasses($id) { $this->class_id = $id; $this->updatedClassId($id); }
 
    public function updatedStudentId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Student::find($value);
        if (!$related) return;
        if (isset($related->class_id)) { $this->class_id = $related->class_id; }
    }

    public function updatedClassId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\SchoolClass::find($value);
        if (!$related) return;
        if (isset($related->student_id)) { $this->student_id = $related->student_id; }
    }
 
    protected function getstudentsList() {
        return \App\Models\SchoolManagement\Student::pluck('name', 'id')->toArray();
    }

    protected function getclassesList() {
        return \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray();
    }

    public function render() { abort_if_cannot('add_attendances'); return view('livewire.admin.school-management.attendances.create', [
            'students' => $this->getstudentsList(),
            'classes' => $this->getclassesList(),
        ])->layout('components.layouts.app'); }
    public function store(CreateAttendanceAction $action) { $this->validate();  $dto = AttendanceDTO::fromArray([
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'date' => $this->date,
            'status' => $this->status,
        ]); $action->execute($dto); session()->flash('success', __('school-management/attendances.created')); return to_route('admin.school-management.attendances.index'); }
    protected function rules(): array { return Attendance::rules(); }
}