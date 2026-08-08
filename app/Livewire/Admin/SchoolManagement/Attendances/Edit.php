<?php

namespace App\Livewire\Admin\SchoolManagement\Attendances;

use App\Models\SchoolManagement\Attendance;
use App\Domain\SchoolManagement\Attendance\DTOs\AttendanceDTO;
use App\Domain\SchoolManagement\Attendance\Actions\UpdateAttendanceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Attendance')]
class Edit extends Component
{
        use WithPagination;
 public Attendance $item;
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
    }

    public function updatedClassId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\SchoolClass::find($value);
        if (!$related) return;
    }
 
    protected function getstudentsList() {
        return \App\Models\SchoolManagement\Student::pluck('name', 'id')->toArray();
    }

    protected function getclassesList() {
        return \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray();
    }

    public function mount(Attendance $attendance) { $this->item = $attendance; $this->fill($attendance->toArray()); $this->date = $attendance->date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_attendances');
        return view('livewire.admin.school-management.attendances.edit', [
            'students' => $this->getstudentsList(),
            'classes' => $this->getclassesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateAttendanceAction $action) { $this->validate();  $dto = AttendanceDTO::fromArray([
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'date' => $this->date,
            'status' => $this->status,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/attendances.updated')); return to_route('admin.school-management.attendances.index'); }
    protected function rules(): array { return Attendance::rules($this->item->id); }
}