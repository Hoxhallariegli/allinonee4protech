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

#[Title('Add Supplier')]
class Create extends Component
{
        use WithPagination;
     public $name = '';
    public $email = '';
    public $phone = '';
   
    public function render() {
        abort_if_cannot('add_suppliers');
        return view('livewire.admin.auto-repair-management.suppliers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateSupplierAction $action) { $this->validate();  $dto = SupplierDTO::fromArray([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('auto-repair-management/suppliers.created')); return to_route('admin.auto-repair-management.suppliers.index'); }
    protected function rules(): array { return Supplier::rules(); }
}