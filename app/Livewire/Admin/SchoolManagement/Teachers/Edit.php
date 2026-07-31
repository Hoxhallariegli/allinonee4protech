<?php

namespace App\Livewire\Admin\SchoolManagement\Teachers;

use App\Models\SchoolManagement\Teacher;
use App\Domain\SchoolManagement\Teacher\DTOs\TeacherDTO;
use App\Domain\SchoolManagement\Teacher\Actions\UpdateTeacherAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Teacher')]
class Edit extends Component
{
        use WithPagination;
 public Teacher $item;
    public $name = '';
    public $subject = '';
    public $phone = '';
   
    public function mount(Teacher $teacher) { $this->item = $teacher; $this->fill($teacher->toArray());  }
    public function render() { abort_if_cannot('edit_teachers'); return view('livewire.admin.school-management.teachers.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateTeacherAction $action) { $this->validate();  $dto = TeacherDTO::fromArray([
            'name' => $this->name,
            'subject' => $this->subject,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/teachers.updated')); return to_route('admin.school-management.teachers.index'); }
    protected function rules(): array { return Teacher::rules($this->item->id); }
}