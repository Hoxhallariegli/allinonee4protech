<?php

namespace App\Livewire\Admin\ClinicManagement\Doctors;

use App\Models\ClinicManagement\Doctor;
use App\Domain\ClinicManagement\Doctor\Queries\DoctorListQuery;
use App\Domain\ClinicManagement\Doctor\Actions\DeleteDoctorAction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

#[Title('Doctors')]
class Doctors extends Component
{
        use WithPagination;

    public int $paginate = 10;
    #[Url(history: true)] public string $search = '';
    public bool $openFilter = false;
    public string $sortField = 'id';
    public bool $sortAsc = true;

    public function resetFilters() { $this->reset(['search', 'openFilter', ]); $this->resetPage(); }

    public function render()
    {
        abort_if_cannot('view_doctors');
        $query = (new DoctorListQuery())->handle(['search' => $this->search, ], $this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.admin.clinic-management.doctors.index', [
            'items' => $query->paginate($this->paginate),
            'sortableFields' => Doctor::sortable(),
        ])->layout('components.layouts.app');
    }

    public function sortBy($field) { if (!in_array($field, Doctor::sortable(), true)) return; if ($this->sortField === $field) { $this->sortAsc = ! $this->sortAsc; } $this->sortField = $field; }

    public function deleteDoctor($id, DeleteDoctorAction $action) 
    {
        abort_if_cannot('delete_doctors');
        $item = Doctor::find($id);
        if (!$item) { $this->dispatch('toast', message: __('clinic-management/doctors.not_found'), type: 'error'); return; }
        try { $action->execute($item); $this->dispatch('toast', message: __('clinic-management/doctors.deleted'), type: 'success'); $this->resetPage(); } 
        catch (\Illuminate\Database\QueryException $e) { $this->dispatch('toast', message: __('clinic-management/doctors.delete_error_referenced'), type: 'error'); }
        catch (\Exception $e) { $this->dispatch('toast', message: __('clinic-management/doctors.delete_error'), type: 'error'); }
    }
}