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

#[Title('Add Warehouse')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $address = '';
   
    public function render() {
        abort_if_cannot('add_warehouses');
        return view('livewire.admin.warehouse-management.warehouses.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateWarehouseAction $action) { $this->validate();  $dto = WarehouseDTO::fromArray([
            'name' => $this->name,
            'address' => $this->address,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/warehouses.created')); return to_route('admin.warehouse-management.warehouses.index'); }
    protected function rules(): array { return Warehouse::rules(); }
}