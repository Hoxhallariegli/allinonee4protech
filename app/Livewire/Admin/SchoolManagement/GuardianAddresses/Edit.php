<?php

namespace App\Livewire\Admin\SchoolManagement\GuardianAddresses;

use App\Models\SchoolManagement\GuardianAddress;
use App\Domain\SchoolManagement\GuardianAddress\DTOs\GuardianAddressDTO;
use App\Domain\SchoolManagement\GuardianAddress\Actions\UpdateGuardianAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit GuardianAddress')]
class Edit extends Component
{
        use WithPagination;
 public GuardianAddress $item;
    public $guardian_id = '';
    public $line1 = '';
    public $city = '';
 
    #[On('guardian-created')] 
    public function refreshGuardians($id) { $this->guardian_id = $id; $this->updatedGuardianId($id); }
 
    public function updatedGuardianId($value)
    {
        if (!$value) return;
        $related = \App\Models\SchoolManagement\Guardian::find($value);
        if (!$related) return;
    }
 
    protected function getguardiansList() {
        return \App\Models\SchoolManagement\Guardian::pluck('name', 'id')->toArray();
    }

    public function mount(GuardianAddress $guardianAddress) { $this->item = $guardianAddress; $this->fill($guardianAddress->toArray());  }
    public function render() {
        abort_if_cannot('edit_guardian_addresses');
        return view('livewire.admin.school-management.guardian-addresses.edit', [
            'guardians' => $this->getguardiansList(),
        ])->layout('components.layouts.app');
    }
    public function update(UpdateGuardianAddressAction $action) { $this->validate();  $dto = GuardianAddressDTO::fromArray([
            'guardian_id' => $this->guardian_id,
            'line1' => $this->line1,
            'city' => $this->city,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('school-management/guardian-addresses.updated')); return to_route('admin.school-management.guardian-addresses.index'); }
    protected function rules(): array { return GuardianAddress::rules($this->item->id); }
}