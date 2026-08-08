<?php

namespace App\Livewire\Admin\SchoolManagement\Assignments;

use App\Models\SchoolManagement\Assignment;
use App\Domain\SchoolManagement\Assignment\DTOs\AssignmentDTO;
use App\Domain\SchoolManagement\Assignment\Actions\CreateAssignmentAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.assignments.quick-create', [
            'schoolClasses' => $this->getschoolClassesList(),
            'subjects' => $this->getsubjectsList(),
        ]); }

    public function store(CreateAssignmentAction $action)
    {
        $this->validate();
        $dto = AssignmentDTO::fromArray([
            'school_class_id' => $this->school_class_id,
            'subject_id' => $this->subject_id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('assignment-created', id: $item->id);
        $this->js("Livewire.dispatch('assignment-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/assignments.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->title ?? $item->id);
        $this->reset(['school_class_id', 'subject_id', 'title', 'description', 'due_date']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Assignment::rules(); }
}