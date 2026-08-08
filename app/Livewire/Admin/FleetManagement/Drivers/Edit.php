<?php

namespace App\Livewire\Admin\FleetManagement\Drivers;

use App\Models\FleetManagement\Driver;
use App\Domain\FleetManagement\Driver\DTOs\DriverDTO;
use App\Domain\FleetManagement\Driver\Actions\UpdateDriverAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Edit Driver')]
class Edit extends Component
{
        use WithPagination, WithFileUploads;
 public Driver $item;
    public $name = '';
    public $license_number = '';
    public $phone = '';
    public $photo = '';
   
    public function mount(Driver $driver) { $this->item = $driver; $this->fill($driver->toArray());  }
    public function render() {
        abort_if_cannot('edit_drivers');
        return view('livewire.admin.fleet-management.drivers.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateDriverAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/drivers', 'uploads'); }
 $dto = DriverDTO::fromArray([
            'name' => $this->name,
            'license_number' => $this->license_number,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('fleet-management/drivers.updated')); return to_route('admin.fleet-management.drivers.index'); }
    protected function rules(): array { return Driver::rules($this->item->id); }
}