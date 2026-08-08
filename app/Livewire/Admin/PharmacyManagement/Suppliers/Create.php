<?php

namespace App\Livewire\Admin\PharmacyManagement\Suppliers;

use App\Models\PharmacyManagement\Supplier;
use App\Domain\PharmacyManagement\Supplier\DTOs\SupplierDTO;
use App\Domain\PharmacyManagement\Supplier\Actions\CreateSupplierAction;
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
    public $email = '';
   
    public function render() {
        abort_if_cannot('add_suppliers');
        return view('livewire.admin.pharmacy-management.suppliers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateSupplierAction $action) { $this->validate();  $dto = SupplierDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
        ]); $action->execute($dto); session()->flash('success', __('pharmacy-management/suppliers.created')); return to_route('admin.pharmacy-management.suppliers.index'); }
    protected function rules(): array { return Supplier::rules(); }
}