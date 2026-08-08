<?php

namespace App\Livewire\Admin\PharmacyManagement\Prescriptions;

use App\Models\PharmacyManagement\Prescription;
use App\Domain\PharmacyManagement\Prescription\Queries\PrescriptionListQuery;
use App\Domain\PharmacyManagement\Prescription\Actions\DeletePrescriptionAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Prescriptions')]
class Prescriptions extends Component
{
        use WithPagination, WithFileUploads;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_prescriptions');
        $query = (new PrescriptionListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.pharmacy-management.prescriptions.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Prescription::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Prescription::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePrescription($id, DeletePrescriptionAction $action) 
    {
        abort_if_cannot('delete_prescriptions');
        $item = Prescription::find($id);
        if (!$item) { $this->dispatch('toast', message: __('pharmacy-management/prescriptions.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('pharmacy-management/prescriptions.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('pharmacy-management/prescriptions.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('pharmacy-management/prescriptions.delete_error'), type: 'error'); }
    }
}