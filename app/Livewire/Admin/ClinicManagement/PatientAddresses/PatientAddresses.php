<?php

namespace App\Livewire\Admin\ClinicManagement\PatientAddresses;

use App\Models\ClinicManagement\PatientAddress;
use App\Domain\ClinicManagement\PatientAddress\Queries\PatientAddressListQuery;
use App\Domain\ClinicManagement\PatientAddress\Actions\DeletePatientAddressAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('PatientAddresses')]
class PatientAddresses extends Component
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
        abort_if_cannot('view_patient_addresses');
        $query = (new PatientAddressListQuery())->handle(['search' => $this->search,             'patient_id' => $this->patient_id,
], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.clinic-management.patient-addresses.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => PatientAddress::sortable(),
            'patients' => \App\Models\ClinicManagement\Patient::pluck('name', 'id')->toArray(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, PatientAddress::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deletePatientAddress($id, DeletePatientAddressAction $action) 
    {
        abort_if_cannot('delete_patient_addresses');
        $item = PatientAddress::find($id);
        if (!$item) { $this->dispatch('toast', message: __('clinic-management/patient-addresses.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('clinic-management/patient-addresses.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('clinic-management/patient-addresses.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('clinic-management/patient-addresses.delete_error'), type: 'error'); }
    }
}