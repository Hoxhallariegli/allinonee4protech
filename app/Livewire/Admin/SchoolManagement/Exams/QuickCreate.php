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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.exams.quick-create', [
            'classes' => $this->getclassesList(),
        ]); }

    public function store(CreateExamAction $action)
    {
        $this->validate();
        $dto = ExamDTO::fromArray([
            'name' => $this->name,
            'class_id' => $this->class_id,
            'exam_date' => $this->exam_date,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('exam-created', id: $item->id);
        $this->js("Livewire.dispatch('exam-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/exams.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'class_id', 'exam_date']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Exam::rules(); }
}