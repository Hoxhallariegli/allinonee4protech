<?php

namespace App\Livewire\Admin\AutoRepairManagement\Services;

use App\Models\AutoRepairManagement\Service;
use App\Domain\AutoRepairManagement\Service\DTOs\ServiceDTO;
use App\Domain\AutoRepairManagement\Service\Actions\CreateServiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Service')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $duration = '';
   
    public function render() {
        abort_if_cannot('add_services');
        return view('livewire.admin.auto-repair-management.services.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateServiceAction $action) { $this->validate();  $dto = ServiceDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration' => $this->duration,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/services.created')); return to_route('admin.auto-repair-management.services.index'); }
    protected function rules(): array { return Service::rules(); }
}