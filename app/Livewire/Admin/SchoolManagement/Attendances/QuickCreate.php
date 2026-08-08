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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.attendances.quick-create', [
            'students' => $this->getstudentsList(),
            'classes' => $this->getclassesList(),
        ]); }

    public function store(CreateAttendanceAction $action)
    {
        $this->validate();
        $dto = AttendanceDTO::fromArray([
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'date' => $this->date,
            'status' => $this->status,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('attendance-created', id: $item->id);
        $this->js("Livewire.dispatch('attendance-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/attendances.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['student_id', 'class_id', 'date', 'status']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Attendance::rules(); }
}