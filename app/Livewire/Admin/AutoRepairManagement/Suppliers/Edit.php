<?php

namespace App\Livewire\Admin\AutoRepairManagement\Suppliers;

use App\Models\AutoRepairManagement\Supplier;
use App\Domain\AutoRepairManagement\Supplier\DTOs\SupplierDTO;
use App\Domain\AutoRepairManagement\Supplier\Actions\UpdateSupplierAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Supplier')]
class Edit extends Component
{
        use WithPagination;
 public Supplier $item;
    public $name = '';
    public $email = '';
    public $phone = '';
   
    public function mount(Supplier $supplier) { $this->item = $supplier; $this->fill($supplier->toArray());  }
    public function render() { abort_if_cannot('edit_suppliers'); return view('livewire.admin.auto-repair-management.suppliers.edit', [
        ])->layout('components.layouts.app'); }
    public function update(UpdateSupplierAction $action) { $this->validate();  $dto = SupplierDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('auto-repair-management/suppliers.updated')); return to_route('admin.auto-repair-management.suppliers.index'); }
    protected function rules(): array { return Supplier::rules($this->item->id); }
}