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

class QuickCreate extends Component
{
        use WithPagination;
     public $total_amount = '';
    public $sale_date = '';
   
    public bool $created = false;
    public ?int $createdId = null;
    public string $createdLabel = '';

    public function render() { return view('livewire.admin.pharmacy-management.sales.quick-create', [
        ]); }

    public function store(CreateSaleAction $action)
    {
        $this->validate();
        $dto = SaleDTO::fromArray([
            'total_amount' => $this->total_amount,
            'sale_date' => $this->sale_date,
        ]);
        $item = $action->execute($dto);
        $this->dispatch('sale-created', id: $item->id);
        $this->js("Livewire.dispatch('sale-created', { id: {$item->id} })");
        $this->dispatch('toast', message: __('pharmacy-management/sales.created'), type: 'success');
        $this->created = true;
        $this->createdId = $item->id;
        $this->createdLabel = (string) ($item->id ?? $item->id);
        $this->reset(['total_amount', 'sale_date']);
    }

    public function addAnother()
    {
        $this->created = false;
        $this->createdId = null;
        $this->createdLabel = '';
    }

    protected function rules(): array { return Sale::rules(); }
}