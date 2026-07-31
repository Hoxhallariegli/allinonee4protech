<?php

namespace App\Livewire\Admin\AutoRepairManagement\Suppliers;

use App\Models\AutoRepairManagement\Supplier;
use App\Domain\AutoRepairManagement\Supplier\DTOs\SupplierDTO;
use App\Domain\AutoRepairManagement\Supplier\Actions\CreateSupplierAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class QuickCreate extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.auto-repair-management.suppliers.quick-create', [
        ]); }

    public function store(CreateSupplierAction $action)
    {
        $this->validate();
        $dto = SupplierDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('supplier-created', id: $item->id);
        $this->js("Livewire.dispatch('supplier-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('auto-repair-management/suppliers.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->name ?? $item->id);
        $this->reset(['name', 'email', 'phone']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Supplier::rules(); }
}