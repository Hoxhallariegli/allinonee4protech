<?php

namespace App\Livewire\Admin\ConstructionERP\Suppliers;

use App\Models\ConstructionERP\Supplier;
use App\Domain\ConstructionERP\Supplier\DTOs\SupplierDTO;
use App\Domain\ConstructionERP\Supplier\Actions\CreateSupplierAction;
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
        return view('livewire.admin.construction-e-r-p.suppliers.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateSupplierAction $action) { $this->validate();  $dto = SupplierDTO::fromArray([
            'name' => $this->name,
            'phone' => $this->phone,
        ]); $action->execute($dto); session()->flash('success', __('construction-e-r-p/suppliers.created')); return to_route('admin.construction-e-r-p.suppliers.index'); }
    protected function rules(): array { return Supplier::rules(); }
}