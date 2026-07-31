<?php

namespace App\Livewire\Admin\SchoolManagement\Guardians;

use App\Models\SchoolManagement\Guardian;
use App\Domain\SchoolManagement\Guardian\DTOs\GuardianDTO;
use App\Domain\SchoolManagement\Guardian\Actions\UpdateGuardianAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Guardian')]
class Edit extends Component
{
        use WithPagination;
 public Guardian $item;
    public $name = '';
    public $phone = '';
    public $email = '';
   
    public function mount(Guardian $guardian) { $this->item = $guardian; $this->fill($guardian->toArray());  }
    public function render() { abort_if_cannot('edit_guardians'); return view('livewire.admin.school-management.guardians.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateGuardianAction $action) { $this->validate();  $dto = GuardianDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/guardians.updated')); return to_route('admin.school-management.guardians.index'); }
    protected function rules(): array { return Guardian::rules($this->item->id); }
}