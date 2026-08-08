<?php

namespace App\Livewire\Admin\PharmacyManagement\Sales;

use App\Models\PharmacyManagement\Sale;
use App\Domain\PharmacyManagement\Sale\DTOs\SaleDTO;
use App\Domain\PharmacyManagement\Sale\Actions\UpdateSaleAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Edit Sale')]
class Edit extends Component
{
        use WithPagination;
 public Sale $item;
    public $total_amount = '';
    public $sale_date = '';
   
    public function mount(Sale $sale) { $this->item = $sale; $this->fill($sale->toArray()); $this->sale_date = $sale->sale_date?->format('Y-m-d'); }
    public function render() {
        abort_if_cannot('edit_sales');
        return view('livewire.admin.pharmacy-management.sales.edit', [
        ])->layout('components.layouts.app');
    }
    public function update(UpdateSaleAction $action) { $this->validate();  $dto = SaleDTO::fromArray([
            'total_amount' => $this->total_amount,
            'sale_date' => $this->sale_date,
        ]); $action->execute($this->item, $dto); session()->flash('success', __('pharmacy-management/sales.updated')); return to_route('admin.pharmacy-management.sales.index'); }
    protected function rules(): array { return Sale::rules($this->item->id); }
}