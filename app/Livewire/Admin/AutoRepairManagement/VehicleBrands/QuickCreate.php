<?php

namespace App\Livewire\Admin\AutoRepairManagement\VehicleBrands;

use App\Models\AutoRepairManagement\VehicleBrand;
use App\Domain\AutoRepairManagement\VehicleBrand\DTOs\VehicleBrandDTO;
use App\Domain\AutoRepairManagement\VehicleBrand\Actions\CreateVehicleBrandAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.vehicle-brands.quick-create', [
        ]); }

    public function store(CreateVehicleBrandAction $action)
    {
        $this->validate();
        $dto = VehicleBrandDTO::fromArray([
            'name' => $this->name,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('vehicle-brand-created', id: $item->id);
        $this->js("Livewire.dispatch('vehicle-brand-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/vehicle-brands.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return VehicleBrand::rules(); }
}