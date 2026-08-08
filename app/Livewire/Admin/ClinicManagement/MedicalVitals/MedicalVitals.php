<?php

namespace App\Livewire\Admin\ClinicManagement\MedicalVitals;

use App\Models\ClinicManagement\MedicalVital;
use App\Domain\ClinicManagement\MedicalVital\Queries\MedicalVitalListQuery;
use App\Domain\ClinicManagement\MedicalVital\Actions\DeleteMedicalVitalAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('MedicalVitals')]
class MedicalVitals extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    #[Url(history: true)] public $patient_id = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', 'patient_id', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_medical_vitals');
        $query = (new MedicalVitalListQuery())->handle(['search' => $this->search,             'patient_id' => $this->patient_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.clinic-management.medical-vitals.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => MedicalVital::sortable(),
            'patients' => \App\Models\ClinicManagement\Patient::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, MedicalVital::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteMedicalVital($id, DeleteMedicalVitalAction $action) 
    {
        abort_if_cannot('delete_medical_vitals');
        $item = MedicalVital::find($id);
        if (!$item) { $this->dispatch('toast', message: __('clinic-management/medical-vitals.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('clinic-management/medical-vitals.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('clinic-management/medical-vitals.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('clinic-management/medical-vitals.delete_error'), type: 'error'); }
    }
}