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

#[Title('Add Subject')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $code = '';
   
    public function render() {
        abort_if_cannot('add_subjects');
        return view('livewire.admin.school-management.subjects.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateSubjectAction $action) { $this->validate();  $dto = SubjectDTO::fromArray([
            'name' => $this->name,
            'code' => $this->code,
        ]); $action->execute($dto); session()->flash('success', __('school-management/subjects.created')); return to_route('admin.school-management.subjects.index'); }
    protected function rules(): array { return Subject::rules(); }
}