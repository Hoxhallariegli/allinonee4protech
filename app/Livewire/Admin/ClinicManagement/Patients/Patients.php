<?php

namespace App\Livewire\Admin\ClinicManagement\Patients;

use App\Models\ClinicManagement\Patient;
use App\Domain\ClinicManagement\Patient\Queries\PatientListQuery;
use App\Domain\ClinicManagement\Patient\Actions\DeletePatientAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

#[Title('Patients')]
class Patients extends Component
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
        abort_if_cannot('view_patients');
        $query = (new PatientListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.clinic-management.patients.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Patient::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Patient::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePatient($id, DeletePatientAction $action) 
    {
        abort_if_cannot('delete_patients');
        $item = Patient::find($id);
        if (!$item) { $this->dispatch('toast', message: __('clinic-management/patients.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('clinic-management/patients.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('clinic-management/patients.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('clinic-management/patients.delete_error'), type: 'error'); }
    }
}