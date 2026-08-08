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

#[Title('Add Driver')]
class Create extends Component
{
        use WithPagination, WithFileUploads;
     public $name = '';
    public $license_number = '';
    public $phone = '';
    public $photo = '';
   
    public function render() {
        abort_if_cannot('add_drivers');
        return view('livewire.admin.fleet-management.drivers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateDriverAction $action) { $this->validate();         if ($this->photo && !is_string($this->photo)) { $this->photo = $this->photo->store('uploads/drivers', 'uploads'); }
 $dto = DriverDTO::fromArray([
            'name' => $this->name,
            'license_number' => $this->license_number,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]); $action->execute($dto); session()->flash('success', __('fleet-management/drivers.created')); return to_route('admin.fleet-management.drivers.index'); }
    protected function rules(): array { return Driver::rules(); }
}