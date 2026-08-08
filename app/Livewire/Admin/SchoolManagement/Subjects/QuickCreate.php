<?php

namespace App\Livewire\Admin\SchoolManagement\Subjects;

use App\Models\SchoolManagement\Subject;
use App\Domain\SchoolManagement\Subject\DTOs\SubjectDTO;
use App\Domain\SchoolManagement\Subject\Actions\CreateSubjectAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $code = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.subjects.quick-create', [
        ]); }

    public function store(CreateSubjectAction $action)
    {
        $this->validate();
        $dto = SubjectDTO::fromArray([
            'name' => $this->name,
            'code' => $this->code,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('subject-created', id: $item->id);
        $this->js("Livewire.dispatch('subject-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/subjects.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'code']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Subject::rules(); }
}