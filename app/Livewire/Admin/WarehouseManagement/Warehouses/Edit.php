<?php

namespace App\Livewire\Admin\WarehouseManagement\Warehouses;

use App\Models\WarehouseManagement\Warehouse;
use App\Domain\WarehouseManagement\Warehouse\DTOs\WarehouseDTO;
use App\Domain\WarehouseManagement\Warehouse\Actions\UpdateWarehouseAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Warehouse')]
class Edit extends Component
{
        use WithPagination;
 public Warehouse $item;
    public $name = '';
    public $address = '';
   
    public function mount(Warehouse $warehouse) { $this->item = $warehouse; $this->fill($warehouse->toArray());  }
    public function render() {
        abort_if_cannot('edit_warehouses');
        return view('livewire.admin.warehouse-management.warehouses.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateWarehouseAction $action) { $this->validate();  $dto = WarehouseDTO::fromArray([
            'name' => $this->name,
            'address' => $this->address,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('warehouse-management/warehouses.updated')); return to_route('admin.warehouse-management.warehouses.index'); }
    protected function rules(): array { return Warehouse::rules($this->item->id); }
}