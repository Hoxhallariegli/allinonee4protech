<?php

namespace App\Livewire\Admin\SchoolManagement\Exams;

use App\Models\SchoolManagement\Exam;
use App\Domain\SchoolManagement\Exam\DTOs\ExamDTO;
use App\Domain\SchoolManagement\Exam\Actions\UpdateExamAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Exam')]
class Edit extends Component
{
        use WithPagination;
 public Exam $item;
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

    public function mount(Exam $exam) { $this->item = $exam; $this->fill($exam->toArray()); $this->exam_date = $exam->exam_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_exams');
        return view('livewire.admin.school-management.exams.edit', [
            'classes' => $this->getclassesList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateExamAction $action) { $this->validate();  $dto = ExamDTO::fromArray([
            'name' => $this->name,
            'class_id' => $this->class_id,
            'exam_date' => $this->exam_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/exams.updated')); return to_route('admin.school-management.exams.index'); }
    protected function rules(): array { return Exam::rules($this->item->id); }
}