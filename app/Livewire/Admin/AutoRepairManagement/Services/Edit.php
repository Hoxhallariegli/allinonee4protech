<?php

namespace App\Livewire\Admin\AutoRepairManagement\Services;

use App\Models\AutoRepairManagement\Service;
use App\Domain\AutoRepairManagement\Service\DTOs\ServiceDTO;
use App\Domain\AutoRepairManagement\Service\Actions\UpdateServiceAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Service')]
class Edit extends Component
{
        use WithPagination;
 public Service $item;
    public $name = '';
    public $price = '';
    public $duration = '';
   
    public function mount(Service $service) { $this->item = $service; $this->fill($service->toArray());  }
    public function render() { abort_if_cannot('edit_services'); return view('livewire.admin.auto-repair-management.services.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateServiceAction $action) { $this->validate();  $dto = ServiceDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration' => $this->duration,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/services.updated')); return to_route('admin.auto-repair-management.services.index'); }
    protected function rules(): array { return Service::rules($this->item->id); }
}