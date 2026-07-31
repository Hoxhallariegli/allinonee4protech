<?php

namespace App\Livewire\Admin\WarehouseManagement\Warehouses;

use App\Models\WarehouseManagement\Warehouse;
use App\Domain\WarehouseManagement\Warehouse\DTOs\WarehouseDTO;
use App\Domain\WarehouseManagement\Warehouse\Actions\CreateWarehouseAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $address = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.warehouse-management.warehouses.quick-create', [
        ]); }

    public function store(CreateWarehouseAction $action)
    {
        $this->validate();
        $dto = WarehouseDTO::fromArray([
            'name' => $this->name,
            'address' => $this->address,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('warehouse-created', id: $item->id);
        $this->js("Livewire.dispatch('warehouse-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('warehouse-management/warehouses.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'address']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Warehouse::rules(); }
}