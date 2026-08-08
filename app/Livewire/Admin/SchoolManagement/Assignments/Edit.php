<?php

namespace App\Livewire\Admin\SchoolManagement\Assignments;

use App\Models\SchoolManagement\Assignment;
use App\Domain\SchoolManagement\Assignment\DTOs\AssignmentDTO;
use App\Domain\SchoolManagement\Assignment\Actions\UpdateAssignmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Assignment')]
class Edit extends Component
{
        use WithPagination;
 public Assignment $item;
    public $school_class_id = '';
    public $subject_id = '';
    public $title = '';
    public $description = '';
    public $due_date = '';
 
    #[On('school-class-created')] 
    public function refreshSchoolClasses($id) { $this->school_class_id = $id; $this->updatedSchoolClassId($id); }

    #[On('subject-created')] 
    public function refreshSubjects($id) { $this->subject_id = $id; $this->updatedSubjectId($id); }
 
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
 
    protected function getschoolClassesList() {
        return \App\Models\SchoolManagement\SchoolClass::pluck('name', 'id')->toArray();
    }

    protected function getsubjectsList() {
        return \App\Models\SchoolManagement\Subject::pluck('name', 'id')->toArray();
    }

    public function mount(Assignment $assignment) { $this->item = $assignment; $this->fill($assignment->toArray()); $this->due_date = $assignment->due_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_assignments');
        return view('livewire.admin.school-management.assignments.edit', [
            'schoolClasses' => $this->getschoolClassesList(),
            'subjects' => $this->getsubjectsList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateAssignmentAction $action) { $this->validate();  $dto = AssignmentDTO::fromArray([
            'school_class_id' => $this->school_class_id,
            'subject_id' => $this->subject_id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/assignments.updated')); return to_route('admin.school-management.assignments.index'); }
    protected function rules(): array { return Assignment::rules($this->item->id); }
}