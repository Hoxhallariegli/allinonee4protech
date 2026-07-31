<?php

namespace App\Livewire\Admin\SchoolManagement\Grades;

use App\Models\SchoolManagement\Grade;
use App\Domain\SchoolManagement\Grade\DTOs\GradeDTO;
use App\Domain\SchoolManagement\Grade\Actions\CreateGradeAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $student_id = '';
    public $exam_id = '';
    public $score = '';
 
    #[On('student-created')] 
    public function refreshStudents($id) { $this->student_id = $id; $this->updatedStudentId($id); }

    #[On('exam-created')] 
    public function refreshExams($id) { $this->exam_id = $id; $this->updatedExamId($id); }
 
    public function updatedStudentId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Student::find($value);
        if (!$related) return;
        if (isset($related->exam_id)) { $this->exam_id = $related->exam_id; }
    }

    public function updatedExamId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Exam::find($value);
        if (!$related) return;
        if (isset($related->student_id)) { $this->student_id = $related->student_id; }
    }
 
    protected function getstudentsList() {
        return \App\Models\SchoolManagement\Student::pluck('name', 'id')->toArray();
    }

    protected function getexamsList() {
        return \App\Models\SchoolManagement\Exam::pluck('name', 'id')->toArray();
    }

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.grades.quick-create', [
            'students' => $this->getstudentsList(),
            'exams' => $this->getexamsList(),
        ]); }

    public function store(CreateGradeAction $action)
    {
        $this->validate();
        $dto = GradeDTO::fromArray([
            'student_id' => $this->student_id,
            'exam_id' => $this->exam_id,
            'score' => $this->score,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('grade-created', id: $item->id);
        $this->js("Livewire.dispatch('grade-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/grades.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['student_id', 'exam_id', 'score']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Grade::rules(); }
}