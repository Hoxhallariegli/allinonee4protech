<?php

namespace App\Livewire\Admin\SchoolManagement\Subjects;

use App\Models\SchoolManagement\Subject;
use App\Domain\SchoolManagement\Subject\DTOs\SubjectDTO;
use App\Domain\SchoolManagement\Subject\Actions\UpdateSubjectAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Subject')]
class Edit extends Component
{
        use WithPagination;
 public Subject $item;
    public $name = '';
    public $code = '';
   
    public function mount(Subject $subject) { $this->item = $subject; $this->fill($subject->toArray());  }
    public function render() {
        abort_if_cannot('edit_subjects');
        return view('livewire.admin.school-management.subjects.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateSubjectAction $action) { $this->validate();  $dto = SubjectDTO::fromArray([
            'name' => $this->name,
            'code' => $this->code,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/subjects.updated')); return to_route('admin.school-management.subjects.index'); }
    protected function rules(): array { return Subject::rules($this->item->id); }
}