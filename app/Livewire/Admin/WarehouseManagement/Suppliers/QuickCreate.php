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

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $phone = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.warehouse-management.suppliers.quick-create', [
        ]); }

    public function store(CreateSupplierAction $action)
    {
        $this->validate();
        $dto = SupplierDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('supplier-created', id: $item->id);
        $this->js("Livewire.dispatch('supplier-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('warehouse-management/suppliers.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'phone']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Supplier::rules(); }
}