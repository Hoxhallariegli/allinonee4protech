<?php

namespace App\Livewire\Admin\SchoolManagement\Teachers;

use App\Models\SchoolManagement\Teacher;
use App\Domain\SchoolManagement\Teacher\DTOs\TeacherDTO;
use App\Domain\SchoolManagement\Teacher\Actions\CreateTeacherAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Add Teacher')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $subject = '';
    public $phone = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_teachers');
        return view('livewire.admin.school-management.teachers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateTeacherAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/teachers', 'uploads'); }
 $dto = TeacherDTO::fromArray([
            'name' => $this->name,
            'subject' => $this->subject,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('school-management/teachers.created')); return to_route('admin.school-management.teachers.index'); }
    protected function rules(): array { return Teacher::rules(); }
}