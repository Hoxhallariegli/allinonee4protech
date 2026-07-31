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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $price = '';
    public $duration = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.services.quick-create', [
        ]); }

    public function store(CreateServiceAction $action)
    {
        $this->validate();
        $dto = ServiceDTO::fromArray([
            'name' => $this->name,
            'price' => $this->price,
            'duration' => $this->duration,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('service-created', id: $item->id);
        $this->js("Livewire.dispatch('service-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/services.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'price', 'duration']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Service::rules(); }
}