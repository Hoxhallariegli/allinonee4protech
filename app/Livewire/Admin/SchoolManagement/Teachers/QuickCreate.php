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

class QuickCreate extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $subject = '';
    public $phone = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.teachers.quick-create', [
        ]); }

    public function store(CreateTeacherAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/teachers', 'uploads'); }
        $dto = TeacherDTO::fromArray([
            'name' => $this->name,
            'subject' => $this->subject,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('teacher-created', id: $item->id);
        $this->js("Livewire.dispatch('teacher-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/teachers.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'subject', 'phone', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Teacher::rules(); }
}