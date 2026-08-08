<?php

namespace App\Livewire\Admin\SchoolManagement\Timetables;

use App\Models\SchoolManagement\Timetable;
use App\Domain\SchoolManagement\Timetable\DTOs\TimetableDTO;
use App\Domain\SchoolManagement\Timetable\Actions\CreateTimetableAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Timetable')]
class Create extends Component
{
        use WithPagination;
     public $school_class_id = '';
    public $subject_id = '';
    public $teacher_id = '';
    public $day = '';
    public $start_time = '';
    public $end_time = '';
 
    #[On('school-class-created')] 
    public function refreshSchoolClasses($id) { $this->school_class_id = $id; $this->updatedSchoolClassId($id); }

    #[On('subject-created')] 
    public function refreshSubjects($id) { $this->subject_id = $id; $this->updatedSubjectId($id); }

    #[On('teacher-created')] 
    public function refreshTeachers($id) { $this->teacher_id = $id; $this->updatedTeacherId($id); }
 
    public function updatedSchoolClassId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\SchoolClass::find($value);
        if (!$related) return;
    }

    public function updatedSubjectId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Subject::find($value);
        if (!$related) return;
    }

    public function updatedTeacherId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Teacher::find($value);
        if (!$related) return;
    }
 
    protected function getschoolClassesList() {
        return \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray();
    }

    protected function getsubjectsList() {
        return \App\Models\SchoolManagement\Subject::pluck('name', 'id')->toArray();
    }

    protected function getteachersList() {
        return \App\Models\SchoolManagement\Teacher::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_timetables');
        return view('livewire.admin.school-management.timetables.create', [
            'schoolClasses' => $this->getschoolClassesList(),
            'subjects' => $this->getsubjectsList(),
            'teachers' => $this->getteachersList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateTimetableAction $action) { $this->validate();  $dto = TimetableDTO::fromArray([
            'school_class_id' => $this->school_class_id,
            'subject_id' => $this->subject_id,
            'teacher_id' => $this->teacher_id,
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]); $action->execute($dto); session()->flash('success', __('school-management/timetables.created')); return to_route('admin.school-management.timetables.index'); }
    protected function rules(): array { return Timetable::rules(); }
}