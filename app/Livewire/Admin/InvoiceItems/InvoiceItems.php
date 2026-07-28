<?php

namespace App\Livewire\Admin\InvoiceItems;

use App\Models\InvoiceItem;
use App\Domain\InvoiceItem\Queries\InvoiceItemListQuery;
use App\Domain\InvoiceItem\Actions\DeleteInvoiceItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('InvoiceItems')]
class InvoiceItems extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $invoice_id = '';
    #[Url(history: true)] public $service_id = '';
    #[Url(history: true)] public $part_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'invoice_id', 'service_id', 'part_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_invoice_items');
        $query = (new InvoiceItemListQuery())->handle(['search' => $this->search,             'invoice_id' => $this->invoice_id,
            'service_id' => $this->service_id,
            'part_id' => $this->part_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.invoice-items.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => InvoiceItem::sortable(),
            'invoices' => \App\Models\Invoice::pluck('id', 'id')->toArray(),
            'services' => \App\Models\Service::pluck('name', 'id')->toArray(),
            'parts' => \App\Models\Part::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, InvoiceItem::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteInvoiceItem($id, DeleteInvoiceItemAction $action) 
    {
        abort_if_cannot('delete_invoice_items');
        $item = InvoiceItem::find($id);
        if (!$item) { $this->dispatch('toast', message: __('invoice-items.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('invoice-items.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('invoice-items.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('invoice-items.delete_error'), type: 'error'); }
    }
}