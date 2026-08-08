<?php

namespace App\Livewire\Admin\SchoolManagement\GuardianAddresses;

use App\Models\SchoolManagement\GuardianAddress;
use App\Domain\SchoolManagement\GuardianAddress\DTOs\GuardianAddressDTO;
use App\Domain\SchoolManagement\GuardianAddress\Actions\CreateGuardianAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add GuardianAddress')]
class Create extends Component
{
        use WithPagination;
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

    public function render() {
        abort_if_cannot('add_guardian_addresses');
        return view('livewire.admin.school-management.guardian-addresses.create', [
            'guardians' => $this->getguardiansList(),
        ])->layout('components.layouts.app');
    }
    public function store(CreateGuardianAddressAction $action) { $this->validate();  $dto = GuardianAddressDTO::fromArray([
            'guardian_id' => $this->guardian_id,
            'line1' => $this->line1,
            'city' => $this->city,
        ]); $action->execute($dto); session()->flash('success', __('school-management/guardian-addresses.created')); return to_route('admin.school-management.guardian-addresses.index'); }
    protected function rules(): array { return GuardianAddress::rules(); }
}