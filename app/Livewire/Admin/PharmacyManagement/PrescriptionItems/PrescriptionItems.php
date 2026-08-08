<?php

namespace App\Livewire\Admin\PharmacyManagement\PrescriptionItems;

use App\Models\PharmacyManagement\PrescriptionItem;
use App\Domain\PharmacyManagement\PrescriptionItem\Queries\PrescriptionItemListQuery;
use App\Domain\PharmacyManagement\PrescriptionItem\Actions\DeletePrescriptionItemAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('PrescriptionItems')]
class PrescriptionItems extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $prescription_id = '';
    #[Url(history: true)] public $medicine_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'prescription_id', 'medicine_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_prescription_items');
        $query = (new PrescriptionItemListQuery())->handle(['search' => $this->search,             'prescription_id' => $this->prescription_id,
            'medicine_id' => $this->medicine_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.pharmacy-management.prescription-items.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => PrescriptionItem::sortable(),
            'prescriptions' => \App\Models\PharmacyManagement\Prescription::pluck('id', 'id')->toArray(),
            'medicines' => \App\Models\PharmacyManagement\Medicine::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, PrescriptionItem::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePrescriptionItem($id, DeletePrescriptionItemAction $action) 
    {
        abort_if_cannot('delete_prescription_items');
        $item = PrescriptionItem::find($id);
        if (!$item) { $this->dispatch('toast', message: __('pharmacy-management/prescription-items.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('pharmacy-management/prescription-items.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('pharmacy-management/prescription-items.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('pharmacy-management/prescription-items.delete_error'), type: 'error'); }
    }
}