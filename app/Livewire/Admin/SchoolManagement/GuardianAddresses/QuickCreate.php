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

class QuickCreate extends Component
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

    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.school-management.guardian-addresses.quick-create', [
            'guardians' => $this->getguardiansList(),
        ]); }

    public function store(CreateGuardianAddressAction $action)
    {
        $this->validate();
        $dto = GuardianAddressDTO::fromArray([
            'guardian_id' => $this->guardian_id,
            'line1' => $this->line1,
            'city' => $this->city,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('guardian-address-created', id: $item->id);
        $this->js("Livewire.dispatch('guardian-address-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('school-management/guardian-addresses.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['guardian_id', 'line1', 'city']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return GuardianAddress::rules(); }
}