<?php

namespace App\Livewire\Admin\SchoolManagement\Exams;

use App\Models\SchoolManagement\Exam;
use App\Domain\SchoolManagement\Exam\DTOs\ExamDTO;
use App\Domain\SchoolManagement\Exam\Actions\CreateExamAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Exam')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $class_id = '';
    public $exam_date = '';
 
    #[On('school-class-created')] 
    public function refreshClasses($id) { $this->class_id = $id; $this->updatedClassId($id); }
 
    public function updatedClassId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\SchoolClass::find($value);
        if (!$related) return;
    }
 
    protected function getclassesList() {
        return \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray();
    }

    public function render() {
        abort_if_cannot('add_exams');
        return view('livewire.admin.school-management.exams.create', [
            'classes' => $this->getclassesList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateExamAction $action) { $this->validate();  $dto = ExamDTO::fromArray([
            'name' => $this->name,
            'class_id' => $this->class_id,
            'exam_date' => $this->exam_date,
        ]); $action->execute($dto); session()->flash('success', __('school-management/exams.created')); return to_route('admin.school-management.exams.index'); }
    protected function rules(): array { return Exam::rules(); }
}