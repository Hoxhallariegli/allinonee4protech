<?php

namespace App\Livewire\Admin\PharmacyManagement\Sales;

use App\Models\PharmacyManagement\Sale;
use App\Domain\PharmacyManagement\Sale\DTOs\SaleDTO;
use App\Domain\PharmacyManagement\Sale\Actions\CreateSaleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Add Sale')]
class Create extends Component
{
        use WithPagination;
     public $total_amount = '';
    public $sale_date = '';
   
    public function render() {
        abort_if_cannot('add_sales');
        return view('livewire.admin.pharmacy-management.sales.create', [
        ])->layout('components.layouts.app');
    }
    public function store(CreateSaleAction $action) { $this->validate();  $dto = SaleDTO::fromArray([
            'total_amount' => $this->total_amount,
            'sale_date' => $this->sale_date,
        ]); $action->execute($dto); session()->flash('success', __('pharmacy-management/sales.created')); return to_route('admin.pharmacy-management.sales.index'); }
    protected function rules(): array { return Sale::rules(); }
}