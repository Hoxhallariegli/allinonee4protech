<?php

namespace App\Livewire\Admin\WarehouseManagement\Suppliers;

use App\Models\WarehouseManagement\Supplier;
use App\Domain\WarehouseManagement\Supplier\DTOs\SupplierDTO;
use App\Domain\WarehouseManagement\Supplier\Actions\CreateSupplierAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Supplier')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
   
    public function render() {
        abort_if_cannot('add_suppliers');
        return view('livewire.admin.warehouse-management.suppliers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateSupplierAction $action) { $this->validate();  $dto = SupplierDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('warehouse-management/suppliers.created')); return to_route('admin.warehouse-management.suppliers.index'); }
    protected function rules(): array { return Supplier::rules(); }
}