<?php

namespace App\Livewire\Admin\SchoolManagement\Guardians;

use App\Models\SchoolManagement\Guardian;
use App\Domain\SchoolManagement\Guardian\DTOs\GuardianDTO;
use App\Domain\SchoolManagement\Guardian\Actions\CreateGuardianAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Guardian')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
    public $email = '';
   
    public function render() {
        abort_if_cannot('add_guardians');
        return view('livewire.admin.school-management.guardians.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateGuardianAction $action) { $this->validate();  $dto = GuardianDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]); $action->execute($dto); session()->flash('success', __('school-management/guardians.created')); return to_route('admin.school-management.guardians.index'); }
    protected function rules(): array { return Guardian::rules(); }
}