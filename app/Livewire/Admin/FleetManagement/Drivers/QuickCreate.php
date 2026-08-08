<?php

namespace App\Livewire\Admin\FleetManagement\Drivers;

use App\Models\FleetManagement\Driver;
use App\Domain\FleetManagement\Driver\DTOs\DriverDTO;
use App\Domain\FleetManagement\Driver\Actions\CreateDriverAction;
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
    public $license_number = '';
    public $phone = '';
    public $photo = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.fleet-management.drivers.quick-create', [
        ]); }

    public function store(CreateDriverAction $action)
    {
        $this->validate();
        if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/drivers', 'uploads'); }
        $dto = DriverDTO::fromArray([
            'name' => $this->name,
            'license_number' => $this->license_number,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('driver-created', id: $item->id);
        $this->js("Livewire.dispatch('driver-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('fleet-management/drivers.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'license_number', 'phone', 'photo']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Driver::rules(); }
}